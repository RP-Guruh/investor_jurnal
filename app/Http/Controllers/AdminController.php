<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        $user = User::where('status', 'investor')->paginate(10);

        return view('admin.dashboard', [
            'user' => $user,
        ]);
    }

    public function pemasukan()
    {
        $user = User::where('status', 'investor')->paginate(10);

        return view('admin.riwayat_pemasukan', [
            'user' => $user,
        ]);
    }

    public function pemasukan_anggota(Request $request, $id)
    {
        $pemasukan = Pemasukan::where('id_anggota', $id)->paginate(10);
        foreach ($pemasukan as $data) {
            $id = $data->id_anggota;
        }
        $user = User::where('id_anggota', $id)->get(['name']);
        foreach ($user as $data) {
            $nama = $data->name;
        }
        return view('admin.pemasukan_anggota', [
            'pemasukan' => $pemasukan,
            'id_anggota' => $id,
            'nama' => $nama,
        ]);
    }

    public function form_pemasukan($id)
    {
        return view('admin.pemasukan_form', [
            'id' => $id,
        ]);
    }

    public function proses_pemasukan(Request $request)
    {
        $pin = mt_rand(10000, 99999)
            . mt_rand(10000, 99999);
        $string = "INVC-" . str_shuffle($pin);
        $pemasukan = new Pemasukan();
        $pemasukan->id = null;
        $pemasukan->id_pemasukan = $string;
        $pemasukan->id_anggota = $request->id_anggota;
        $pemasukan->nominal = $request->nominal;
        $pemasukan->tanggal_pemasukan = $request->tgl_pemasukan;
        $pemasukan->save();
        toast("Data pemasukan berhasil di input", 'success');
        return redirect('/admin/pemasukan/' . $request->id_anggota);
    }
}
