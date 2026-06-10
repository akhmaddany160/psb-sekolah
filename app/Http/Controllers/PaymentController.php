<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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

    /**
     * Handle incoming secure payment webhook from n8n.
     */
    public function handleWebhook(Request $request)
    {
        // 1. Validasi Token Keamanan
        $expectedToken = env('WEBHOOK_TOKEN', 'secure_n8n_token_default');
        $incomingToken = $request->header('X-Webhook-Token');

        if ($incomingToken !== $expectedToken) {
            Log::warning('Percobaan akses webhook tidak sah (Token salah/kosong).');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // 2. Validasi Input Payload
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'payment_type' => 'required|string|in:formulir,daftar_ulang',
            'status' => 'required|string|in:LUNAS',
        ]);

        // 3. Update Status Pembayaran Siswa
        $user = User::findOrFail($request->user_id);
        
        if ($request->payment_type === 'formulir') {
            $user->pembayaran_formulir = 'LUNAS';
            Log::info("Pembayaran Formulir sukses via n8n untuk siswa ID: {$user->id}");
        } elseif ($request->payment_type === 'daftar_ulang') {
            $user->pembayaran_daftar_ulang = 'LUNAS';
            Log::info("Pembayaran Daftar Ulang sukses via n8n untuk siswa ID: {$user->id}");
        }

        $user->save();

        // Ambil nomor WA dari studentDetail, atau phone_number dari tabel users
        $phone = $user->studentDetail->no_wa ?? $user->phone_number ?? '';
        
        // Bersihkan format nomor agar hanya angka
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Pastikan diawali dengan 62 (standar WhatsApp internasional)
        if (str_starts_with($phone, '08')) {
            $phone = '628' . substr($phone, 2);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '628' . substr($phone, 1);
        }

        return response()->json([
            'message' => 'Status pembayaran berhasil diperbarui!',
            'student_id' => $user->id,
            'student_name' => $user->name,
            'student_phone' => $phone,
            'pembayaran_formulir' => $user->pembayaran_formulir,
            'pembayaran_daftar_ulang' => $user->pembayaran_daftar_ulang,
        ], 200);
    }

    /**
     * Check current logged-in user's payment status.
     */
    public function checkStatus()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'UNAUTHENTICATED'], 401);
        }
        
        return response()->json([
            'pembayaran_formulir' => $user->pembayaran_formulir,
            'pembayaran_daftar_ulang' => $user->pembayaran_daftar_ulang,
        ], 200);
    }
}
