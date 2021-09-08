<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\User;
use App\Models\FileLaporan;

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
        $pemasukan = Pemasukan::where('id_anggota', $id)->orderBy('tanggal_pemasukan', 'desc')->paginate(10);
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

    public function hapus_pemasukan($id, $id_anggota) {
        $pemasukan = Pemasukan::where('id_pemasukan', $id)->delete();
        alert()->success('Berhasil Hapus','Data pemasukan berhasil di hapus');
        return redirect('/admin/pemasukan/' . $id_anggota);
    }

    public function edit_pemasukan($id, $id_anggota) {

        $pemasukan = Pemasukan::where('id_pemasukan', $id)->get();
    
        return view('admin.edit_pemasukan', [
            'id_pemasukan' => $id,
            'id_anggota' => $id_anggota,
            'pemasukan' => $pemasukan,
        ]);
    }

    public function update_pemasukan(Request $request) {
        $pemasukan = Pemasukan::where('id_pemasukan', $request->id_pemasukan)
                    ->update([
                        'id_pemasukan' => $request->id_pemasukan,
                        'id_anggota' => $request->id_anggota,
                        'nominal' =>  $request->nominal,
                        'tanggal_pemasukan' => $request->tgl_pemasukan,
                        'keterangan' => $request->keterangan,
                        'updated_at' => date("Y-m-d h:i:s"),
                    ]);
        toast("Data pemasukan berhasil di update", 'success');
        return redirect('/admin/pemasukan/' . $request->id_anggota);
               
    }

    public function laporan() {
        $file = FileLaporan::paginate(10);
        return view('admin.laporan', [
            'laporan' => $file,
        ]);
    }
}
