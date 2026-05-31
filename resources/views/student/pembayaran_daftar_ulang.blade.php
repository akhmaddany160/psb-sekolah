<x-app-layout>
    <div style="width: 100%; padding: 40px 0; background-color: #ffffff; min-height: 100vh; font-family: sans-serif;">
        <div style="width: 100%; max-width: 800px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

            @if (session('success'))
                <div style="margin-bottom: 24px; padding: 16px; background-color: #d1e7dd; color: #0f5132; border-radius: 12px; font-weight: bold; border: 1px solid #badbcc; text-align: center; font-size: 15px;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('status'))
                <div style="margin-bottom: 24px; padding: 16px; background-color: #fff3cd; color: #664d03; border-radius: 12px; font-weight: bold; border: 1px solid #ffecb5; text-align: center; font-size: 15px;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Main Container (Gray Theme matching Biodata) --}}
            <div style="background-color: #D9D9D9; border-radius: 30px; padding: 40px; color: #000000; box-sizing: border-box; width: 100%; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);">
                
                <div style="text-align: center; margin-bottom: 30px;">
                    <h2 style="font-size: 24px; font-weight: 900; font-style: italic; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; color: #1F2937;">
                        Daftar Ulang & Administrasi
                    </h2>
                    <p style="font-size: 14px; color: #4B5563; margin: 6px 0 0 0; font-weight: 700;">
                        PKBM Abu Dzar Al-Ghifari
                    </p>
                </div>

                @if ($isLocked)
                    
                    {{-- ==================== STATE: LOCKED (BELUM LULUS) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 50px 30px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 2px dashed #EF4444;">
                        
                        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #FEE2E2; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 40px; height: 40px; color: #EF4444; fill: none; stroke: currentColor; stroke-width: 2.5;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>

                        <h3 style="font-size: 18px; font-weight: 900; color: #991B1B; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                            Langkah Belum Terbuka
                        </h3>
                        <p style="font-size: 14px; color: #4B5563; line-height: 1.6; max-width: 500px; margin: 0 auto; font-weight: 600;">
                            Tahap Pembayaran Daftar Ulang & Administrasi belum dibuka. 
                            Anda harus menyelesaikan **Ujian Seleksi** dan dinyatakan **LULUS** terlebih dahulu sebelum dapat mengakses langkah ini.
                        </p>
                    </div>

                @elseif ($user->pembayaran_daftar_ulang === 'LUNAS')
                    
                    {{-- ==================== STATE: LUNAS (SUCCESS) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 3px solid #10B981;">
                        
                        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #D1FAE5; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 44px; height: 44px; color: #10B981; fill: none; stroke: currentColor; stroke-width: 3;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>

                        <h3 style="font-size: 22px; font-weight: 900; color: #065F46; margin: 0 0 10px 0; text-transform: uppercase; font-style: italic;">
                            Selamat Bergabung!
                        </h3>
                        <h4 style="font-size: 15px; font-weight: 700; color: #374151; margin: 0 0 24px 0;">Calon Siswa PKBM Abu Dzar Al-Ghifari</h4>
                        
                        <p style="font-size: 14px; color: #4B5563; line-height: 1.6; max-width: 550px; margin: 0 auto 30px auto; font-weight: 600;">
                            Alhamdulillah, pembayaran daftar ulang Anda telah lunas diverifikasi. 
                            Anda kini telah resmi terdaftar sebagai siswa di PKBM Abu Dzar Al-Ghifari. 
                            Silakan unduh atau cetak Kartu Pelajar Anda di bawah ini.
                        </p>

                        <div style="display: inline-block; background-color: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 16px; padding: 20px; margin-bottom: 35px; text-align: left; width: 100%; max-width: 480px; box-sizing: border-box;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                                <span style="color: #6B7280; font-weight: 700;">Jenjang Sekolah:</span>
                                <span style="color: #1F2937; font-weight: 900;">
                                    @if($user->jenjang == 'SD') PMC Kids (TK) @elseif($user->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                                <span style="color: #6B7280; font-weight: 700;">Nominal Pembayaran:</span>
                                <span style="color: #1F2937; font-weight: 900;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 13px;">
                                <span style="color: #6B7280; font-weight: 700;">Status Administrasi:</span>
                                <span style="color: #10B981; font-weight: 900;">Lunas & Terverifikasi</span>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: center;">
                            <a href="{{ route('student.kartu_pelajar') }}" style="background-color: #1F2937; color: #ffffff; font-size: 16px; font-weight: 900; padding: 16px 40px; border-radius: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.style.backgroundColor='#10B981'" onmouseout="this.style.backgroundColor='#1F2937'">
                                Lihat / Cetak Kartu Pelajar
                            </a>
                        </div>
                    </div>

                @else

                    {{-- ==================== STATE: OPEN & UNPAID (INVOICE) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 30px;">
                        
                        <h4 style="font-size: 16px; font-weight: 900; color: #1F2937; margin: 0 0 20px 0; border-bottom: 2px solid #F3F4F6; padding-bottom: 12px; text-transform: uppercase;">
                            Rincian Tagihan Daftar Ulang
                        </h4>

                        <div style="margin-bottom: 20px; font-size: 13px; color: #6B7280; font-weight: 700;">
                            Calon Siswa: <span style="color: #1F2937; font-weight: 900;">{{ $user->name }}</span><br>
                            Program Jenjang: 
                            <span style="color: #1F2937; font-weight: 900;">
                                @if($user->jenjang == 'SD') PMC Kids (TK) @elseif($user->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif
                            </span>
                        </div>

                        {{-- Item Breakdown --}}
                        <div style="display: flex; flex-direction: column; gap: 14px; margin-top: 10px;">
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #4B5563; font-weight: 600;">1. Uang Pangkal & Pembangunan</span>
                                <span style="color: #1F2937; font-weight: 800;">
                                    @if($user->jenjang == 'SD') Rp 800.000 @elseif($user->jenjang == 'SMP') Rp 1.000.000 @else Rp 1.200.000 @endif
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #4B5563; font-weight: 600;">2. Uang SPP Bulan Pertama</span>
                                <span style="color: #1F2937; font-weight: 800;">
                                    @if($user->jenjang == 'SD') Rp 200.000 @elseif($user->jenjang == 'SMP') Rp 300.000 @else Rp 400.000 @endif
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                <span style="color: #4B5563; font-weight: 600;">3. Biaya Seragam & Paket Buku</span>
                                <span style="color: #1F2937; font-weight: 800;">Rp 200.000</span>
                            </div>
                        </div>

                        <div style="background-color: #F9FAFB; border-radius: 12px; padding: 20px; border: 1px solid #E5E7EB; margin-top: 30px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 16px; font-weight: 900; color: #1F2937;">
                                <span>TOTAL TAGIHAN</span>
                                <span style="color: #312E81; font-size: 18px;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Simulator Sandbox Panel --}}
                    <div style="background-color: #ECFDF5; border: 2px dashed #10B981; border-radius: 20px; padding: 30px; text-align: center;">
                        <div style="width: 48px; height: 48px; border-radius: 50%; background-color: #D1FAE5; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto;">
                            <svg style="width: 24px; height: 24px; color: #10B981; fill: none; stroke: currentColor; stroke-width: 2.5;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        
                        <h4 style="font-size: 16px; font-weight: 900; color: #065F46; margin: 0 0 8px 0; text-transform: uppercase;">
                            Simulasi Pembayaran Sandbox
                        </h4>
                        <p style="font-size: 13px; color: #047857; line-height: 1.5; max-width: 480px; margin: 0 auto 24px auto; font-weight: 600;">
                            Klik tombol di bawah ini untuk mensimulasikan pembayaran daftar ulang sukses. Fitur uji coba ini gratis.
                        </p>

                        <form method="POST" action="{{ route('student.pembayaran.daftar_ulang.simulate') }}">
                            @csrf
                            <button type="submit" id="pay-ulang-btn" style="background-color: #10B981; color: #ffffff; font-size: 15px; font-weight: 900; padding: 14px 36px; border: none; border-radius: 12px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);">
                                Bayar via Simulator (Lunas)
                            </button>
                        </form>
                    </div>

                @endif

            </div>

        </div>
    </div>

    <style>
        #pay-ulang-btn:hover {
            background-color: #059669 !important;
            transform: scale(1.02);
        }
    </style>
</x-app-layout>
