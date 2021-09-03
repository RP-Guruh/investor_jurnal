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
        return view('admin.pemasukan_anggota', [
            'pemasukan' => $pemasukan,
        ]);
    }
}
