<x-app-layout>
    <div style="width: 100%; padding: 40px 0; background-color: #ffffff; min-height: 100vh; font-family: sans-serif;">
        <div style="width: 100%; max-width: 800px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

            @if (session('success'))
                <div style="margin-bottom: 24px; padding: 16px; background-color: #d1e7dd; color: #0f5132; border-radius: 12px; font-weight: bold; border: 1px solid #badbcc; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Gray solid container matching the Biodata & Test layout --}}
            <div style="background-color: #D9D9D9; border-radius: 30px; padding: 40px; color: #000000; box-sizing: border-box; width: 100%; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);">

                @if ($test->status === 'LULUS')
                    
                    {{-- ==================== DISPLAY LULUS (SUCCESS STATE) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 3px solid #10B981;">
                        
                        {{-- Success Badge Icon --}}
                        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #D1FAE5; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 44px; height: 44px; color: #10B981; fill: none; stroke: currentColor; stroke-width: 3;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>

                        <h2 style="font-size: 26px; font-weight: 900; font-style: italic; color: #065F46; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px;">Selamat, Anda Lulus!</h2>
                        <h4 style="font-size: 16px; font-weight: 700; color: #374151; margin: 0 0 30px 0;">Calon Siswa PKBM Abu Dzar Al-Ghifari</h4>

                        {{-- Certificate Border Decorative Score Box --}}
                        <div style="display: inline-block; background-color: #F0FDF4; border: 2px dashed #34D399; border-radius: 16px; padding: 24px 50px; margin-bottom: 30px; min-width: 250px;">
                            <span style="display: block; font-size: 12px; font-weight: 800; color: #047857; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Skor Ujian Anda</span>
                            <span style="font-size: 48px; font-weight: 900; color: #059669; font-family: monospace;">{{ $test->score }}</span>
                            <span style="display: block; font-size: 13px; font-weight: 700; color: #047857; margin-top: 6px;">
                                (Benar {{ $test->score / 25 }} dari 4 Soal)
                            </span>
                        </div>

                        <p style="font-size: 15px; color: #4B5563; line-height: 1.6; max-width: 550px; margin: 0 auto 35px auto;">
                            Selamat! Anda dinyatakan lulus ujian seleksi akademik untuk jenjang pendaftaran 
                            <span style="font-weight: 800; color: #065F46;">
                                @if($test->jenjang == 'SD') PMC Kids (TK) @elseif($test->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif</span>. 
                            Silakan lanjutkan ke tahap berikutnya untuk menyelesaikan administrasi pendaftaran.
                        </p>

                        {{-- Action Button --}}
                        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                            <a href="#" style="background-color: #1F2937; color: #ffffff; font-size: 16px; font-weight: 900; padding: 16px 40px; border-radius: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.style.backgroundColor='#10B981'" onmouseout="this.style.backgroundColor='#1F2937'">
                                Lanjut Pembayaran Daftar Ulang
                            </a>
                        </div>

                    </div>

                @else

                    {{-- ==================== DISPLAY GAGAL (FAIL STATE) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 3px solid #EF4444;">
                        
                        {{-- Warning Badge Icon --}}
                        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #FEE2E2; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 44px; height: 44px; color: #EF4444; fill: none; stroke: currentColor; stroke-width: 3;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>

                        <h2 style="font-size: 26px; font-weight: 900; font-style: italic; color: #991B1B; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px;">Hasil Ujian: Cadangan</h2>
                        <h4 style="font-size: 16px; font-weight: 700; color: #374151; margin: 0 0 30px 0;">Calon Siswa PKBM Abu Dzar Al-Ghifari</h4>

                        {{-- Crimson Score Box --}}
                        <div style="display: inline-block; background-color: #FEF2F2; border: 2px dashed #F87171; border-radius: 16px; padding: 24px 50px; margin-bottom: 30px; min-width: 250px;">
                            <span style="display: block; font-size: 12px; font-weight: 800; color: #B91C1C; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Skor Ujian Anda</span>
                            <span style="font-size: 48px; font-weight: 900; color: #DC2626; font-family: monospace;">{{ $test->score }}</span>
                            <span style="display: block; font-size: 13px; font-weight: 700; color: #B91C1C; margin-top: 6px;">
                                (Batas Minimal Kelulusan: 75)
                            </span>
                        </div>

                        <p style="font-size: 15px; color: #4B5563; line-height: 1.6; max-width: 550px; margin: 0 auto 35px auto;">
                            Jangan berkecil hati! Skor Anda belum memenuhi batas minimal kelulusan untuk jenjang 
                            <span style="font-weight: 800; color: #991B1B;">
                                @if($test->jenjang == 'SD') PMC Kids (TK) @elseif($test->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif</span>. 
                            Anda tetap dapat berkesempatan masuk sebagai status **Cadangan**, silakan hubungi tim Admin kami untuk mendapatkan arahan lebih lanjut atau konsultasi ujian remedial.
                        </p>

                        {{-- WhatsApp Button Integration --}}
                        <div style="display: flex; justify-content: center; gap: 16px;">
                            <a href="https://wa.me/6285880037794?text=Halo%20Admin%20PKBM%20Abu%20Dzar%20Al-Ghifari,%20saya%20ingin%20konsultasi%20mengenai%20Hasil%20Ujian%20Seleksi%20saya%20atas%20nama%20{{ urlencode($user->name) }}%20(Skor:%20{{ $test->score }})" target="_blank" style="background-color: #25D366; color: #ffffff; font-size: 16px; font-weight: 900; padding: 16px 40px; border-radius: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 10px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.style.backgroundColor='#128C7E'" onmouseout="this.style.backgroundColor='#25D366'">
                                <svg style="width: 20px; height: 20px; fill: currentColor;" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.503-5.727-1.465L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.413 9.863-9.832.002-2.623-1.023-5.09-2.885-6.957C16.59 1.952 14.135.927 11.517.927c-5.442 0-9.866 4.415-9.869 9.833-.001 1.761.488 3.48 1.417 4.981l-.995 3.637 3.737-.978zm11.391-7.25c-.292-.146-1.729-.856-1.996-.954-.266-.099-.461-.147-.656.146-.195.293-.755.954-.927 1.149-.171.195-.343.219-.635.074-.292-.146-1.236-.456-2.355-1.453-.872-.778-1.46-1.739-1.631-2.03-.171-.293-.018-.452.128-.597.133-.131.292-.343.439-.513.146-.171.195-.293.292-.488.098-.195.049-.366-.024-.513-.073-.146-.656-1.586-.9-2.172-.238-.572-.48-.493-.656-.502-.17-.008-.366-.01-.561-.01-.195 0-.513.073-.78.366-.268.293-1.024 1.001-1.024 2.441 0 1.439 1.048 2.83 1.195 3.025.147.195 2.062 3.149 4.996 4.417.697.302 1.24.482 1.66.617.7.223 1.338.192 1.843.116.562-.085 1.729-.708 1.974-1.393.244-.684.244-1.27.171-1.392-.073-.122-.268-.195-.561-.341z"/></svg>
                                Hubungi Admin via WhatsApp
                            </a>
                        </div>

                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
