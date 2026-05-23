<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentDocumentController extends Controller
{
    /**
     * Tampilkan halaman pemberkasan beserta berkas yang sudah diunggah.
     */
    public function edit()
    {
        $document = auth()->user()->studentDocument;
        return view('student.pemberkasan', compact('document'));
    }

    /**
     * Unggah berkas baru.
     */
    public function store(Request $request)
    {
        $allowedTypes = [
            'ijazah',
            'transkrip_nilai',
            'akta_kelahiran',
            'kartu_keluarga',
            'nisn',
            'ktp_ortu',
            'sertifikat_prestasi',
            'sertifikat_tahfidz',
            'pas_foto',
        ];

        // Validasi seluruh kemungkinan file input
        $rules = [];
        foreach ($allowedTypes as $type) {
            if ($type === 'pas_foto') {
                // Pas Foto hanya boleh gambar (tidak boleh PDF)
                $rules[$type] = 'nullable|file|mimes:jpeg,png,jpg|max:2048';
            } else {
                $rules[$type] = 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048';
            }
        }

        $request->validate($rules);

        $user = auth()->user();
        $document = $user->studentDocument;

        $updatedData = [];
        $uploadedAny = false;

        foreach ($allowedTypes as $type) {
            if ($request->hasFile($type)) {
                $file = $request->file($type);

                // Buat nama file unik: tipe_userid_timestamp.ext
                $filename = $type . '_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Simpan berkas di storage/app/public/documents/{user_id}/
                $file->storeAs('documents/' . $user->id, $filename, 'public');

                // Jika ada berkas lama, hapus berkas fisik dari storage
                if ($document && $document->$type) {
                    Storage::disk('public')->delete('documents/' . $user->id . '/' . $document->$type);
                }

                $updatedData[$type] = $filename;
                $uploadedAny = true;
            }
        }

        if ($uploadedAny) {
            $user->studentDocument()->updateOrCreate(
                ['user_id' => $user->id],
                $updatedData
            );
            return back()->with('success', 'Berkas berhasil diunggah!');
        }

        return back()->with('error', 'Tidak ada berkas yang dipilih untuk diunggah.');
    }

    /**
     * Hapus berkas tertentu.
     */
    public function destroy($type)
    {
        $allowedTypes = [
            'ijazah',
            'transkrip_nilai',
            'akta_kelahiran',
            'kartu_keluarga',
            'nisn',
            'ktp_ortu',
            'sertifikat_prestasi',
            'sertifikat_tahfidz',
            'pas_foto',
        ];

        if (!in_array($type, $allowedTypes)) {
            return back()->with('error', 'Tipe dokumen tidak valid.');
        }

        $user = auth()->user();
        $document = $user->studentDocument;

        if ($document && $document->$type) {
            // Hapus file fisik dari storage
            Storage::disk('public')->delete('documents/' . $user->id . '/' . $document->$type);

            // Update kolom di database menjadi null
            $document->update([
                $type => null
            ]);

            return back()->with('success', 'Berkas berhasil dihapus.');
        }

        return back()->with('error', 'Berkas tidak ditemukan.');
    }
}
