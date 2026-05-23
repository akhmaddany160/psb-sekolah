<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function updateJenjang(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'jenjang' => 'required|in:SD,SMP,SMA',
        ]);

        // Simpan pilihan ke database user yang login
        $user = Auth::user();
        $user->update([
            'jenjang' => $request->jenjang
        ]);

        // Arahkan ke menu 2 (Biodata) setelah berhasil simpan
        return redirect()->route('student.profile.edit')->with('status', 'Jenjang berhasil dipilih!');
    }
}