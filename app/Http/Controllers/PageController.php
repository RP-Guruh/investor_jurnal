<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{

    public function dashboard_user()
    {
        setlocale(LC_TIME, 'id_ID');

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
        $pendapatan_beserta_nominal = $total_pendapatan + $nominal;

        if (Auth::user()->status == "investor") {
            return view('pages/user_dashboard', [
                'nominal_investasi' => number_format($nominal, 2, ',', '.'),
                'nama' => $nama,
                'tgl_gabung' => $tgl_gabung,
                'total_pemasukan' => number_format($total_pendapatan, 2, ',', '.'),
                'jumlah_pendapatan' => number_format($pendapatan_beserta_nominal, 2, ',', '.'),
                'riwayat_pemasukan' => $riwayat_pemasukan,
                'jumlah_dana_investasi' => number_format($jumlah_dana_investasi, 2, ',', '.'),
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
            'wa.required'     => 'WA harus di isid',
            'password.required'     => 'Password harus di isi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            toast("Opps :( " . $validator->errors()->first(), 'error');
            return redirect()->back();
        } else {

            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenamaSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('foto')->storeAs('public/photo_profil', $filenamaSimpan);

            $user = User::find(Auth::user()->id);
            $user->name = $request->fullname;
            $user->id_anggota = Auth::user()->id_anggota;
            $user->no_wa = $request->wa;
            $user->pekerjaan = $request->pekerjaan;
            $user->instansi = $request->instansi;
            $user->email = $request->email;
            $user->photo = $filenamaSimpan;
            $user->password = Hash::make($request->password);
            $user->updated_at = date("Y/m/d h:i:sa");
            $user->active = "1";
            $user->save();

            toast("Profil dan Password berhasil diubah", 'success');
            return redirect('/profil');
        }
    }
}
