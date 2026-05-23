<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDetailController extends Controller
{
    public function edit()
    {
        // Ambil data detail milik user yang sedang login
        $detail = Auth::user()->studentDetail;
        return view('student.profile', compact('detail'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:10',
            'asal_sekolah' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Simpan atau Update data
        Auth::user()->studentDetail()->updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only(['nisn', 'asal_sekolah', 'alamat'])
        );

        return redirect()->back()->with('status', 'Data berhasil disimpan!');
    }

    public function store(Request $request)
    {
        // Gabungkan tanggal lahir siswa
        if ($request->filled(['birth_year', 'birth_month', 'birth_day'])) {
            $request->merge([
                'tanggal_lahir' => "{$request->birth_year}-{$request->birth_month}-{$request->birth_day}"
            ]);
        }

        // Gabungkan tanggal lahir ayah
        if ($request->filled(['ayah_birth_year', 'ayah_birth_month', 'ayah_birth_day'])) {
            $request->merge([
                'tanggal_lahir_ayah' => "{$request->ayah_birth_year}-{$request->ayah_birth_month}-{$request->ayah_birth_day}"
            ]);
        }

        // Gabungkan tanggal lahir ibu
        if ($request->filled(['ibu_birth_year', 'ibu_birth_month', 'ibu_birth_day'])) {
            $request->merge([
                'tanggal_lahir_ibu' => "{$request->ibu_birth_year}-{$request->ibu_birth_month}-{$request->ibu_birth_day}"
            ]);
        }

        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nik'           => 'nullable|string|max:16',
            'nisn'          => 'nullable|string|max:10',
            'asal_sekolah'  => 'nullable|string|max:255',
            'alamat'        => 'nullable|string',
            'no_wa'         => 'nullable|string|max:30',
            
            // Orang Tua
            'nama_ayah'          => 'nullable|string|max:255',
            'nama_ibu'           => 'nullable|string|max:255',
            'tanggal_lahir_ayah' => 'nullable|date',
            'tanggal_lahir_ibu'  => 'nullable|date',
            'alamat_ortu'        => 'nullable|string',
            'no_wa_ortu'         => 'nullable|string|max:30',
            'pekerjaan_ayah'     => 'nullable|string|max:255',
            'pekerjaan_ibu'      => 'nullable|string|max:255',

            // Wali (Opsional)
            'nama_wali'      => 'nullable|string|max:255',
            'no_wa_wali'     => 'nullable|string|max:30',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'alamat_wali'    => 'nullable|string',
        ]);

        // Format WhatsApp numbers if present
        if (!empty($validated['no_wa'])) {
            $validated['no_wa'] = $this->formatWhatsApp($validated['no_wa']);
        }
        if (!empty($validated['no_wa_ortu'])) {
            $validated['no_wa_ortu'] = $this->formatWhatsApp($validated['no_wa_ortu']);
        }
        if (!empty($validated['no_wa_wali'])) {
            $validated['no_wa_wali'] = $this->formatWhatsApp($validated['no_wa_wali']);
        }

        auth()->user()->studentDetail()->updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return back()->with('success', 'Data biodata berhasil disimpan!');
    }

    private function formatWhatsApp($number)
    {
        if (empty($number)) {
            return null;
        }

        // Hapus semua karakter non-numerik kecuali +
        $number = preg_replace('/[^0-9+]/', '', $number);

        // Jika sudah diawali +62
        if (str_starts_with($number, '+62')) {
            return $number;
        }

        // Jika diawali 62 tapi tanpa +
        if (str_starts_with($number, '62')) {
            return '+' . $number;
        }

        // Jika diawali 0, ganti dengan +62
        if (str_starts_with($number, '0')) {
            return '+62' . substr($number, 1);
        }

        // Default prepend +62
        return '+62' . $number;
    }
}