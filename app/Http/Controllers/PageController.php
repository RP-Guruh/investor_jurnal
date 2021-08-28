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


class PageController extends Controller
{

    public function dashboard_user()
    {
        setlocale(LC_TIME, 'id_ID');

        $user = User::where('id_anggota', Auth::user()->id_anggota)->get();
        $jumlah_investor = User::where('status', 'investor')->count();
        $total_pendapatan = Pemasukan::where('id_anggota', Auth::user()->id_anggota)->sum('nominal');
        $riwayat_pemasukan = Pemasukan::where('id_anggota', Auth::user()->id_anggota)->orderBy('tanggal_pemasukan')->paginate(10);
        $jumlah_dana_investasi = User::where('status', 'investor')->sum('nominal_investasi');
        foreach ($user as $data) {
            $tgl_gabung = date("d-M-Y", strtotime($data->tanggal_bergabung));
            $nominal = $data->nominal_investasi;
            $nama = $data->name;
        };

        if (Auth::user()->status == "investor") {
            return view('pages/user_dashboard', [
                'nominal_investasi' => number_format($nominal, 2, ',', '.'),
                'nama' => $nama,
                'tgl_gabung' => $tgl_gabung,
                'jumlah_investor' => $jumlah_investor,
                'jumlah_pendapatan' => number_format($total_pendapatan, 2, ',', '.'),
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
        $rules = [
            'foto'    => 'mimes:png|required|max:10000', // max 10 MB
            'nama' => 'required',
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

            'nama.required'     => 'Nama harus di isi',
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
        }
    }
}
