<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Show the Pembayaran Formulir UI page.
     */
    public function showFormulir()
    {
        $user = Auth::user();

        // Cek apakah user sudah memilih jenjang
        if (empty($user->jenjang)) {
            return redirect()->route('dashboard')->with('status', 'Silakan pilih jenjang sekolah terlebih dahulu sebelum melakukan pembayaran formulir.');
        }

        return view('student.pembayaran_formulir', compact('user'));
    }

    /**
     * Simulate a successful Formulir payment (Sandbox).
     */
    public function simulateFormulir(Request $request)
    {
        $user = Auth::user();

        if (empty($user->jenjang)) {
            return redirect()->route('dashboard')->with('status', 'Silakan pilih jenjang sekolah terlebih dahulu.');
        }

        // Update status pembayaran formulir ke LUNAS
        $user->pembayaran_formulir = 'LUNAS';
        $user->save();

        return redirect()->route('student.pembayaran.formulir')->with('success', 'Simulasi Pembayaran Sukses! Biaya pendaftaran pendaftaran & formulir Anda sebesar Rp 150.000 telah lunas.');
    }

    /**
     * Show the Pembayaran Daftar Ulang UI page.
     */
    public function showDaftarUlang()
    {
        $user = Auth::user();

        // Cek apakah user sudah memilih jenjang
        if (empty($user->jenjang)) {
            return redirect()->route('dashboard')->with('status', 'Silakan pilih jenjang sekolah terlebih dahulu.');
        }

        $test = $user->studentTest;
        $isLocked = !$test || $test->status !== 'LULUS';

        $amount = 0;
        if (!$isLocked) {
            // Nominal dinamis berdasarkan jenjang
            if ($user->jenjang === 'SD') {
                $amount = 1200000; // PMC Kids (TK)
            } elseif ($user->jenjang === 'SMP') {
                $amount = 1500000; // PMC Home School (SD)
            } else {
                $amount = 1800000; // Al-Bayan School (SMP/SMA)
            }
        }

        return view('student.pembayaran_daftar_ulang', compact('user', 'isLocked', 'amount', 'test'));
    }

    /**
     * Simulate a successful Daftar Ulang payment (Sandbox).
     */
    public function simulateDaftarUlang(Request $request)
    {
        $user = Auth::user();

        if (empty($user->jenjang)) {
            return redirect()->route('dashboard')->with('status', 'Silakan pilih jenjang sekolah terlebih dahulu.');
        }

        $test = $user->studentTest;
        if (!$test || $test->status !== 'LULUS') {
            return redirect()->route('student.pembayaran.daftar_ulang')->with('status', 'Anda belum diizinkan melakukan daftar ulang karena belum lulus seleksi akademik.');
        }

        // Update status pembayaran daftar ulang ke LUNAS
        $user->pembayaran_daftar_ulang = 'LUNAS';
        $user->save();

        return redirect()->route('student.pembayaran.daftar_ulang')->with('success', 'Simulasi Pembayaran Sukses! Pembayaran daftar ulang Anda telah lunas dan diverifikasi oleh sistem.');
    }

    /**
     * Show the Kartu Pelajar UI page.
     */
    public function showKartuPelajar()
    {
        $user = Auth::user();

        // Cek apakah user sudah memilih jenjang
        if (empty($user->jenjang)) {
            return redirect()->route('dashboard')->with('status', 'Silakan pilih jenjang sekolah terlebih dahulu.');
        }

        $test = $user->studentTest;
        $isLulus = $test && $test->status === 'LULUS';
        $isDaftarUlangLunas = $user->pembayaran_daftar_ulang === 'LUNAS';

        $isLocked = !$isLulus || !$isDaftarUlangLunas;

        $detail = $user->studentDetail;
        $document = $user->studentDocument;

        return view('student.kartu_pelajar', compact('user', 'isLocked', 'detail', 'document', 'test'));
    }
}
