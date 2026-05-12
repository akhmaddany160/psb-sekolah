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
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nik'           => 'nullable|digits:16',
            'nisn'          => 'nullable|digits:10',
            'asal_sekolah'  => 'nullable|string',
        ]);

        auth()->user()->studentDetail()->create($validated);

        return back()->with('success', 'Data biodata berhasil disimpan!');
    }
}