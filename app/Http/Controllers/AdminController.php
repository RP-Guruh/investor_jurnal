<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\User;
use App\Models\FileLaporan;
use App\Models\klaim_dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function home()
    {
        $user = User::where('status', 'investor')->orderBy('tanggal_bergabung', 'DESC')->paginate(10);

        // Menghitung dana investor terkumpul
           $nominal_investasi =  User::where('status', 'investor')->sum('nominal_investasi');
        
        // Menghitung jumlah investor terdaftar
            $jumlah_investor =  User::where('status', 'investor')->count();
          
        return view('admin.dashboard', [
            'user' => $user,
            'jumlah_nominal' => number_format( $nominal_investasi, 0, ',', '.'),
            'jumlah_investor' => $jumlah_investor,
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
      
        if($request->keterangan == null) {
            $pemasukan->keterangan = "Tidak ada keterangan";
        }
        else {
            $pemasukan->keterangan = $request->keterangan;
        }
        
        $pemasukan->save();
        toast("Data pemasukan berhasil di input", 'success');
        return redirect('/admin/pemasukan/' . $request->id_anggota);
    }

    public function hapus_pemasukan($id, $id_anggota)
    {
        $pemasukan = Pemasukan::where('id_pemasukan', $id)->delete();
        alert()->success('Berhasil Hapus', 'Data pemasukan berhasil di hapus');
        return redirect('/admin/pemasukan/' . $id_anggota);
    }

    public function edit_pemasukan($id, $id_anggota)
    {

        $pemasukan = Pemasukan::where('id_pemasukan', $id)->get();

        return view('admin.edit_pemasukan', [
            'id_pemasukan' => $id,
            'id_anggota' => $id_anggota,
            'pemasukan' => $pemasukan,
        ]);
    }

    public function update_pemasukan(Request $request)
    {
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

    public function laporan()
    {
        $file = FileLaporan::orderBy('tanggal_upload', 'desc')->paginate(10);
        return view('admin.laporan', [
            'laporan' => $file,
        ]);
    }

    public function form_laporan()
    {

        return view('admin.form_laporan');
    }

    public function process_laporan(Request $request)
    {

        $pin = mt_rand(10000, 99999)
            . mt_rand(10000, 99999);
        $string = "REPORT-" . str_shuffle($pin);

        $file = new FileLaporan();
        $file->id = null;
        $file->id_laporan = $string;
        $file->link = $request->link_file;
        $file->tanggal_upload = $request->tgl_laporan;
        $file->keterangan = $request->keterangan;
        $file->save();

        toast("Data Laporan Berhasil Ditambah", 'success');
        return redirect('/admin/laporan/');
    }

    public function edit_laporan($id)
    {
        $file = FileLaporan::where('id_laporan', $id)->get();
        return view('admin.edit_laporan', [
            'laporan' => $file,
        ]);
    }

    public function update_laporan(Request $request)
    {
        $file = FileLaporan::where('id_laporan', $request->id_laporan)
            ->update([
                'id_laporan' => $request->id_laporan,
                'link' =>  $request->link_file,
                'tanggal_upload' => $request->tgl_laporan,
                'keterangan' => $request->keterangan,
                'updated_at' => date("Y-m-d h:i:s"),
            ]);
        toast("Data laporan berhasil di update", 'success');
        return redirect('/admin/laporan');
    }

    public function delete_laporan($id) {
        $file = FileLaporan::where('id_laporan', $id)->delete();
        alert()->success('Berhasil Hapus', 'Data laporan berhasil di hapus');
        return redirect('/admin/laporan');
    }

    public function form_investor() {
        return view('admin.investor_form');
    }

    public function add_investor(Request $request) {
        $pin = mt_rand(10000, 99999)
            . mt_rand(10000, 99999);
        $string = "USER-" . str_shuffle($pin);
        $user = new User();
        $user->id = null;
        $user->id_anggota = $string;
        $user->name = $request->nama;
        $user->nominal_investasi = $request->nominal;
        $user->status = "investor";
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->tanggal_bergabung = $request->tanggal_gabung;
        $user->active = "0";
        

        $user->save();

        toast("Data investor berhasil ditambah", 'success');
        return redirect('/admin');
    }

    public function delete_investor($id) {
        $user = User::where('id_anggota', $id)->delete();
        alert()->success('Berhasil Hapus', 'Data anggota investor berhasil di hapus');
        return redirect('/admin');
    }

    public function klaim_riwayat()
    {
        $klaim =  klaim_dana::orderBy('tanggal_klaim', 'DESC')->paginate(20);
        return view('admin.riwayat_klaim', [
            'klaim' => $klaim,
        ]);
    }

    public function konfirmasi_klaim($id) {
        klaim_dana::where('id_klaim', $id)
        ->update(['updated_at' => date("Y/m/d"),
                  'status' => "Disetujui"]);
      
        
        alert()->success('Berhasil Disetujui', 'Pengajuan klaim dana di setujui');
        return redirect('admin/klaim/dana');
    }

    public function investor_profil($id) {
        $user = User::where('id_anggota', $id)->get();
        return view('admin.user_detail', [
            'user' => $user,
        ]);

    }
}
