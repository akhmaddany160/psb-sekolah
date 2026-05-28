<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTest;
use Illuminate\Support\Facades\Auth;

class StudentTestController extends Controller
{
    public function showTest()
    {
        $user = Auth::user();

        // 1. Cek apakah user sudah memilih jenjang
        if (empty($user->jenjang)) {
            return redirect()->route('dashboard')->with('status', 'Silakan pilih jenjang sekolah terlebih dahulu sebelum memulai tes seleksi.');
        }

        // 2. Cek apakah user sudah pernah menyelesaikan tes
        $test = $user->studentTest;
        if ($test && $test->status !== 'BELUM_TES') {
            return redirect()->route('student.test.results');
        }

        // 3. Dapatkan soal sesuai jenjang
        $questions = $this->getQuestions($user->jenjang);

        return view('student.test', compact('questions', 'user'));
    }

    public function submitTest(Request $request)
    {
        $user = Auth::user();

        // Cek jika sudah pernah tes
        $existingTest = $user->studentTest;
        if ($existingTest && $existingTest->status !== 'BELUM_TES') {
            return redirect()->route('student.test.results');
        }

        $jenjang = $user->jenjang;
        $questions = $this->getQuestions($jenjang);

        // Validasi input jawaban
        $rules = [];
        foreach ($questions as $q) {
            $rules["q{$q['id']}"] = 'required|in:' . implode(',', array_keys($q['options']));
        }
        $request->validate($rules);

        // Hitung skor
        $score = 0;
        $answers = [];
        foreach ($questions as $q) {
            $key = "q{$q['id']}";
            $userAnswer = $request->input($key);
            $answers[$key] = $userAnswer;

            if ($userAnswer === $q['correct']) {
                $score += 25; // 4 soal, masing-masing 25 poin
            }
        }

        // Tentukan kelulusan (skor >= 75)
        $status = $score >= 75 ? 'LULUS' : 'TIDAK_LULUS';

        // Simpan ke database
        $user->studentTest()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'jenjang' => $jenjang,
                'score' => $score,
                'status' => $status,
                'answers' => $answers,
                'completed_at' => now(),
            ]
        );

        return redirect()->route('student.test.results')->with('success', 'Ujian Anda telah berhasil disimpan!');
    }

    public function showResults()
    {
        $user = Auth::user();
        $test = $user->studentTest;

        // Jika belum tes
        if (!$test || $test->status === 'BELUM_TES') {
            return redirect()->route('student.test.show')->with('status', 'Anda belum mengikuti tes seleksi. Silakan ikuti tes terlebih dahulu.');
        }

        return view('student.results', compact('test', 'user'));
    }

    private function getQuestions($jenjang)
    {
        $questions = [
            'SD' => [
                [
                    'id' => 1,
                    'text' => 'Di bawah ini ada pola: 🍎 - 🍌 - 🍎 - 🍌 - ... Gambar selanjutnya yang tepat adalah?',
                    'options' => [
                        'A' => '🍇 (Anggur)',
                        'B' => '🍎 (Apel)',
                        'C' => '🍌 (Pisang)',
                    ],
                    'correct' => 'B'
                ],
                [
                    'id' => 2,
                    'text' => 'Ayah membeli 3 buah balon, lalu Ibu membelikan lagi 2 buah balon. Berapa jumlah balon sekarang?',
                    'options' => [
                        'A' => '4 Balon',
                        'B' => '5 Balon',
                        'C' => '6 Balon',
                    ],
                    'correct' => 'B'
                ],
                [
                    'id' => 3,
                    'text' => 'Manakah di antara benda berikut yang berbentuk lingkaran dan berwarna merah?',
                    'options' => [
                        'A' => 'Donat cokelat',
                        'B' => 'Tomat matang',
                        'C' => 'Buku tulis biru',
                    ],
                    'correct' => 'B'
                ],
                [
                    'id' => 4,
                    'text' => 'Gambar "B-U-K-U" jika digabungkan menjadi kata...',
                    'options' => [
                        'A' => 'Buka',
                        'B' => 'Kuku',
                        'C' => 'Buku',
                    ],
                    'correct' => 'C'
                ],
            ],
            'SMP' => [
                [
                    'id' => 1,
                    'text' => 'Sebuah toko memberikan diskon 20% untuk sebuah tas seharga Rp100.000. Berapa uang yang harus dibayarkan pembeli?',
                    'options' => [
                        'A' => 'Rp20.000',
                        'B' => 'Rp80.000',
                        'C' => 'Rp90.000',
                        'D' => 'Rp120.000',
                    ],
                    'correct' => 'B'
                ],
                [
                    'id' => 2,
                    'text' => '"Hutan bakau memiliki peran penting untuk mencegah abrasi di garis pantai." Kata abrasi dalam kalimat tersebut memiliki arti...',
                    'options' => [
                        'A' => 'Pengikisan pantai oleh air laut',
                        'B' => 'Pencemaran air oleh limbah',
                        'C' => 'Pasang surut air laut',
                        'D' => 'Penghijauan kembali',
                    ],
                    'correct' => 'A'
                ],
                [
                    'id' => 3,
                    'text' => 'Lanjutkan deret angka berikut: 3, 6, 12, 24, ...',
                    'options' => [
                        'A' => '30',
                        'B' => '36',
                        'C' => '48',
                        'D' => '50',
                    ],
                    'correct' => 'C'
                ],
                [
                    'id' => 4,
                    'text' => 'Proses penguapan air laut menjadi awan dalam siklus hidrologi disebut dengan istilah...',
                    'options' => [
                        'A' => 'Kondensasi',
                        'B' => 'Evaporasi',
                        'C' => 'Presipitasi',
                        'D' => 'Infiltrasi',
                    ],
                    'correct' => 'B'
                ],
            ],
            'SMA' => [
                [
                    'id' => 1,
                    'text' => 'Dalam sebuah antrean, Andi berada di belakang Budi. Cici berada di depan Budi. Dedi berada di belakang Andi. Siapakah yang berada di antrean paling depan?',
                    'options' => [
                        'A' => 'Andi',
                        'B' => 'Budi',
                        'C' => 'Cici',
                        'D' => 'Dedi',
                    ],
                    'correct' => 'C'
                ],
                [
                    'id' => 2,
                    'text' => 'KAKAK : ADIK = BERUANG : ...',
                    'options' => [
                        'A' => 'Madu',
                        'B' => 'Hutan',
                        'C' => 'Anak Beruang',
                        'D' => 'Singa',
                    ],
                    'correct' => 'C'
                ],
                [
                    'id' => 3,
                    'text' => 'Jika x + 3 = 9 dan 2y = x, maka nilai dari y adalah...',
                    'options' => [
                        'A' => '3',
                        'B' => '4',
                        'C' => '6',
                        'D' => '12',
                    ],
                    'correct' => 'A'
                ],
                [
                    'id' => 4,
                    'text' => '"The company decided to postpone the meeting until next week due to the heavy rain." What is the synonym of the bolded word?',
                    'options' => [
                        'A' => 'Cancel',
                        'B' => 'Delay',
                        'C' => 'Continue',
                        'D' => 'Accelerate',
                    ],
                    'correct' => 'B'
                ],
            ],
        ];

        return $questions[$jenjang] ?? [];
    }
}
