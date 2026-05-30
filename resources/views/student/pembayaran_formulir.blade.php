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
                        Pembayaran Formulir
                    </h2>
                    <p style="font-size: 14px; color: #4B5563; margin: 6px 0 0 0; font-weight: 700;">
                        PKBM Abu Dzar Al-Ghifari
                    </p>
                </div>

                @if ($user->pembayaran_formulir === 'LUNAS')
                    
                    {{-- ==================== STATE: LUNAS (SUCCESS) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 40px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 3px solid #10B981;">
                        
                        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #D1FAE5; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 44px; height: 44px; color: #10B981; fill: none; stroke: currentColor; stroke-width: 3;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>

                        <h3 style="font-size: 20px; font-weight: 900; color: #065F46; margin: 0 0 10px 0; text-transform: uppercase;">
                            Pembayaran Lunas
                        </h3>
                        <p style="font-size: 14px; color: #4B5563; margin-bottom: 30px; font-weight: 600;">
                            Terima kasih! Biaya pendaftaran dan pembelian formulir Anda telah lunas diverifikasi oleh sistem.
                        </p>

                        <div style="display: inline-block; background-color: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 16px; padding: 20px 40px; margin-bottom: 35px; text-align: left; width: 100%; max-width: 450px; box-sizing: border-box;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                                <span style="color: #6B7280; font-weight: 700;">Nominal Bayar:</span>
                                <span style="color: #1F2937; font-weight: 900;">Rp 150.000</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 13px;">
                                <span style="color: #6B7280; font-weight: 700;">Metode Pembayaran:</span>
                                <span style="color: #10B981; font-weight: 900;">Virtual Simulator (Lunas)</span>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: center;">
                            <a href="{{ route('student.test.show') }}" style="background-color: #1F2937; color: #ffffff; font-size: 16px; font-weight: 900; padding: 16px 40px; border-radius: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" onmouseover="this.style.backgroundColor='#10B981'" onmouseout="this.style.backgroundColor='#1F2937'">
                                Mulai Tes Seleksi Online
                            </a>
                        </div>
                    </div>

                @else

                    {{-- ==================== STATE: BELUM BAYAR (INVOICE) ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 30px;">
                        
                        <h4 style="font-size: 16px; font-weight: 900; color: #1F2937; margin: 0 0 20px 0; border-bottom: 2px solid #F3F4F6; padding-bottom: 12px; text-transform: uppercase;">
                            Rincian Tagihan Pendaftaran
                        </h4>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                            <div>
                                <span style="display: block; font-size: 15px; font-weight: 800; color: #1F2937;">Formulir Pendaftaran & Administrasi Awal</span>
                                <span style="font-size: 12px; color: #9CA3AF; font-weight: 600;">Berlaku untuk semua jenjang (TK/SD/SMP/SMA)</span>
                            </div>
                            <span style="font-size: 16px; font-weight: 900; color: #1F2937;">Rp 150.000</span>
                        </div>

                        <div style="background-color: #F9FAFB; border-radius: 12px; padding: 20px; border: 1px solid #E5E7EB; margin-top: 30px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 16px; font-weight: 900; color: #1F2937;">
                                <span>TOTAL TAGIHAN</span>
                                <span style="color: #312E81; font-size: 18px;">Rp 150.000</span>
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
                            Klik tombol di bawah ini untuk mensimulasikan proses transfer sukses via bank. Fitur ini disediakan khusus bagi penguji coba sistem secara gratis.
                        </p>

                        <form method="POST" action="{{ route('student.pembayaran.formulir.simulate') }}">
                            @csrf
                            <button type="submit" id="pay-btn" style="background-color: #10B981; color: #ffffff; font-size: 15px; font-weight: 900; padding: 14px 36px; border: none; border-radius: 12px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);">
                                Bayar via Simulator (Lunas)
                            </button>
                        </form>
                    </div>

                @endif

            </div>

        </div>
    </div>

    <style>
        #pay-btn:hover {
            background-color: #059669 !important;
            transform: scale(1.02);
        }
    </style>
</x-app-layout>
