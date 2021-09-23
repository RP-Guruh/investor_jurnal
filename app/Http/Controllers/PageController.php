<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Pemasukan;
use App\Models\FileLaporan;
use App\Models\klaim_dana;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{

    public function dashboard_user()
    {
        setlocale(LC_TIME, 'id_ID');

        // Mendapatkan total klaim
        $dana_klaim = klaim_dana::where([
            ['id_anggota', Auth::user()->id_anggota],
            ['status', 'Disetujui']
        ])->sum('nominal');


        $user = User::where('id_anggota', Auth::user()->id_anggota)->get();
        $jumlah_investor = User::where('status', 'investor')->count();
        $total_pendapatan = Pemasukan::where('id_anggota', Auth::user()->id_anggota)->sum('nominal');
        $riwayat_pemasukan = Pemasukan::where('id_anggota', Auth::user()->id_anggota)->orderBy('tanggal_pemasukan', 'DESC')->paginate(10);

        $jumlah_dana_investasi = User::where('status', 'investor')->sum('nominal_investasi');
        foreach ($user as $data) {
            $tgl_gabung = date("d-M-Y", strtotime($data->tanggal_bergabung));
            $nominal = $data->nominal_investasi;
            $nama = $data->name;
        };


        // Nominal investasi + Pemasukan

        if (Auth::user()->status == "investor") {
            $pendapatan_beserta_nominal = $total_pendapatan + $nominal; //- $dana_klaim

            return view('pages/user_dashboard', [
                'nominal_investasi' => number_format($nominal, 0, ',', '.'),
                'nama' => $nama,
                'tgl_gabung' => $tgl_gabung,
                'total_pemasukan' => number_format($total_pendapatan - $dana_klaim, 0, ',', '.'),
                'jumlah_pendapatan' => number_format($pendapatan_beserta_nominal, 0, ',', '.'),
                'riwayat_pemasukan' => $riwayat_pemasukan,
                'jumlah_dana_investasi' => number_format($jumlah_dana_investasi, 0, ',', '.'),
                'dana_klaim' => number_format($dana_klaim, 0, ',', '.'),
            ]);
        } else {
            return redirect()->route('admin_dashboard');
        }
    }

    public function profil_user()
    {
        $user = User::where('id_anggota', Auth::user()->id_anggota)->get();
        return view('pages/profil_user', [
            'user' => $user,
        ]);
    }

    public function profil_edit($id, Request $request)
    {
        $user = User::where('id_anggota', $id)->get();
        return view('pages/profil_edit', [
            'user' => $user,
        ]);
    }

    public function profil_process(Request $request)
    {

        $password_lama = $request->password_old;


        $rules = [
            'foto'    => 'mimes:jpeg,jpg,png|required|max:10000', // max 10 MB
            'fullname' => 'required',
            'pekerjaan' => 'required',
            'instansi' => 'required',
            'email' => 'required',
            'wa' => 'required',
            'password' => 'required',

        ];
        $messages = [
            'foto.mimes'        => 'Foto  harus berformat png, jpg, jpeg',
            'foto.required'     => 'Foto harus di upload',
            'foto.max'          => 'Size Foto Terlalu Besar, Max.10MB',

            'fullname.required'     => 'Nama harus di isi',
            'pekerjaan.required'     => 'Pekerjaan harus di isi',
            'instansi.required'     => 'Instansi harus di isi',
            'email.required'     => 'Email harus di isi',
            'wa.required'     => 'WA harus di isi',
            'password.required'     => 'Password harus di isi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            toast("Opps :( " . $validator->errors()->first(), 'error');
            return redirect()->back();
        } else {
            $file = Request()->foto;
    
            $path = public_path() . '/foto/profil/' . Auth::user()->id . '/' . Auth::user()->name;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, false);
            }
            $namaFile = 'foto_'.Auth::user()->name .'.' . $file->extension();
            $file->move(public_path('/foto/profil/' . Auth::user()->id . '/' . Auth::user()->name),  $namaFile);

            $user = User::find(Auth::user()->id);
            $user->name = $request->fullname;
            $user->id_anggota = Auth::user()->id_anggota;
            $user->no_wa = $request->wa;
            $user->pekerjaan = $request->pekerjaan;
            $user->instansi = $request->instansi;
            $user->email = $request->email;
            $user->photo = $namaFile;
            $user->password = Hash::make($request->password);
            $user->updated_at = date("Y/m/d h:i:sa");
            $user->active = "1";
            $user->save();

            toast("Profil dan Password berhasil diubah", 'success');
            return redirect('/profil');
        }
    }

    public function laporan()
    {
        $laporan = FileLaporan::orderBy('tanggal_upload', 'DESC')->paginate(10);
        return view('pages.file_laporan', [
            'laporan' => $laporan,
        ]);
    }

    public function klaim_form()
    {

        $klaim =  klaim_dana::where('id_anggota', Auth::user()->id_anggota)->orderBy('tanggal_klaim', 'DESC')->paginate(20);
        return view('pages.riwayat_klaim', [
            'klaim' => $klaim,
        ]);
    }

    public function form_klaim()
    {
        return view('pages.form_klaim');
    }

    public function hapus_klaim($id)
    {
        $klaim = klaim_dana::where('id_klaim', $id);
        $klaim->delete();
        toast("Data klaim berhasil di hapus", 'success');
        return redirect('/klaim/form');
    }

    public function klaim_proses(Request $request)
    {
        $total_pendapatan = Pemasukan::where('id_anggota', Auth::user()->id_anggota)->sum('nominal');
        $nominal = $request->nominal_klaim;

        if ($nominal >= $total_pendapatan) {
            toast("Saldo pemasukan tidak mencukupi", 'error');
            return redirect()->back();
        } else {
            $pin = mt_rand(10000, 99999)
                . mt_rand(10000, 99999);
            $string = "KLAIM-" . str_shuffle($pin);

            $klaim = new klaim_dana();
            $klaim->id = null;
            $klaim->id_klaim = $string;
            $klaim->id_anggota = Auth::user()->id_anggota;
            $klaim->nama = Auth::user()->name;

            $klaim->id_klaim = $string;
            $klaim->tanggal_klaim = date("Y/m/d");
            $klaim->nominal = $nominal;
            if ($klaim->keterangan == null) {
                $klaim->keterangan = "Tidak ada keterangan";
            }

            $klaim->keterangan = $request->keterangan;
            $klaim->status = "Menunggu verifikasi admin";
            $klaim->save();
            toast("Sukses", 'success');
            return redirect('/klaim/form');
        }
    }
}
