<x-app-layout>
    <div style="width: 100%; padding: 40px 0; background-color: #ffffff; min-height: 100vh; font-family: sans-serif;">
        <div style="width: 100%; max-width: 800px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

            {{-- Main Gray Container --}}
            <div style="background-color: #D9D9D9; border-radius: 30px; padding: 40px; color: #000000; box-sizing: border-box; width: 100%; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);">
                
                <div style="text-align: center; margin-bottom: 30px;" class="no-print">
                    <h2 style="font-size: 24px; font-weight: 900; font-style: italic; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; color: #1F2937;">
                        Kartu Pelajar Digital
                    </h2>
                    <p style="font-size: 14px; color: #4B5563; margin: 6px 0 0 0; font-weight: 700;">
                        PKBM Abu Dzar Al-Ghifari
                    </p>
                </div>

                @if ($isLocked)
                    
                    {{-- ==================== STATE: LOCKED ==================== --}}
                    <div style="background-color: #ffffff; border-radius: 20px; padding: 50px 30px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 2px dashed #EF4444;" class="no-print">
                        
                        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #FEE2E2; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                            <svg style="width: 40px; height: 40px; color: #EF4444; fill: none; stroke: currentColor; stroke-width: 2.5;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>

                        <h3 style="font-size: 18px; font-weight: 900; color: #991B1B; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                            Akses Kartu Terkunci
                        </h3>
                        <p style="font-size: 14px; color: #4B5563; line-height: 1.6; max-width: 500px; margin: 0 auto; font-weight: 600;">
                            Kartu Pelajar digital belum diterbitkan. 
                            Langkah ini hanya terbuka jika Anda telah dinyatakan **LULUS** ujian seleksi dan telah menyelesaikan biaya **Pembayaran Daftar Ulang** secara lunas.
                        </p>
                    </div>

                @else

                    {{-- ==================== STATE: UNLOCKED (3D FLIP CARD) ==================== --}}
                    <div class="no-print" style="text-align: center; margin-bottom: 20px; color: #4B5563; font-size: 13px; font-weight: 700; font-style: italic;">
                        💡 Sentuh atau arahkan kursor (hover) pada kartu untuk melihat sisi belakang!
                    </div>

                    <div style="display: flex; justify-content: center; margin-bottom: 40px;" class="no-print">
                        
                        {{-- 3D Card Wrapper --}}
                        <div class="card-container">
                            <div class="card-inner">
                                
                                {{-- 1. FRONT SIDE --}}
                                <div class="card-front">
                                    {{-- Brand Header --}}
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; border-bottom: 1.5px solid rgba(255,255,255,0.15); padding-bottom: 10px;">
                                        <div style="width: 32px; height: 32px; border-radius: 8px; background-color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; color: #1E3A8A; font-size: 14px;">
                                            AD
                                        </div>
                                        <div style="text-align: left;">
                                            <h4 style="margin: 0; font-size: 12px; font-weight: 900; letter-spacing: 0.5px; color: #ffffff; text-transform: uppercase;">PKBM Abu Dzar Al-Ghifari</h4>
                                            <span style="font-size: 8px; color: #93C5FD; font-weight: 700; letter-spacing: 1px;">KARTU IDENTITAS SISWA / STUDENT ID CARD</span>
                                        </div>
                                    </div>

                                    {{-- Card Content --}}
                                    <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between; height: 160px;">
                                        
                                        {{-- Pas Foto --}}
                                        <div style="width: 100px; height: 130px; border-radius: 12px; overflow: hidden; background-color: rgba(255,255,255,0.1); border: 2.5px solid #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                            @if ($document && $document->pas_foto)
                                                <img src="{{ asset('storage/' . $document->pas_foto) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <svg style="width: 50px; height: 50px; color: rgba(255,255,255,0.4);" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                            @endif
                                        </div>

                                        {{-- Student Details --}}
                                        <div style="flex: 1; text-align: left; display: flex; flex-direction: column; gap: 8px; color: #ffffff;">
                                            <div>
                                                <span style="font-size: 9px; color: #93C5FD; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap</span>
                                                <h3 style="margin: 2px 0 0 0; font-size: 15px; font-weight: 900; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 210px;">
                                                    {{ $detail?->nama_lengkap ?? $user->name }}
                                                </h3>
                                            </div>
                                            <div>
                                                <span style="font-size: 9px; color: #93C5FD; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Nomor Induk Siswa Nasional (NISN)</span>
                                                <h4 style="margin: 2px 0 0 0; font-size: 13px; font-weight: 800; font-family: monospace;">
                                                    {{ $detail?->nisn ?? '0098471638' }}
                                                </h4>
                                            </div>
                                            <div>
                                                <span style="font-size: 9px; color: #93C5FD; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Program / Jenjang</span>
                                                <h4 style="margin: 2px 0 0 0; font-size: 12px; font-weight: 800; color: #34D399;">
                                                    @if($user->jenjang == 'SD') PMC Kids (TK) @elseif($user->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif
                                                </h4>
                                            </div>
                                        </div>

                                        {{-- QR Code (Mock Vector Visual) --}}
                                        <div style="width: 64px; height: 64px; background-color: #ffffff; border-radius: 8px; padding: 6px; box-sizing: border-box; flex-shrink: 0; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center;">
                                            <svg style="width: 100%; height: 100%; color: #0F172A;" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 15h6v6H3v-6zm2 2v2h2v-2H5zm10-2h2v2h-2v-2zm2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm-2-2h2v2h-2v-2zm4-4h2v2h-2v-2zm-2 2h2v2h-2v-2z"/>
                                            </svg>
                                        </div>

                                    </div>

                                    {{-- Footer Decorative Bar --}}
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 6px; background-color: #10B981; border-bottom-left-radius: 18px; border-bottom-right-radius: 18px;"></div>
                                </div>

                                {{-- 2. BACK SIDE --}}
                                <div class="card-back">
                                    <h4 style="margin: 0 0 10px 0; font-size: 11px; font-weight: 900; color: #1F2937; text-transform: uppercase; border-bottom: 1px solid #E5E7EB; padding-bottom: 6px; letter-spacing: 0.5px;">
                                        Ketentuan Penggunaan Kartu
                                    </h4>

                                    <ul style="margin: 0 0 15px 0; padding-left: 14px; font-size: 8px; color: #4B5563; text-align: left; line-height: 1.5; font-weight: 700; display: flex; flex-direction: column; gap: 4px;">
                                        <li>Kartu ini adalah tanda pengenal resmi PKBM Abu Dzar Al-Ghifari.</li>
                                        <li>Kartu wajib dibawa selama berada di lingkungan sekolah / ujian.</li>
                                        <li>Penyalahgunaan kartu ini akan dikenakan sanksi tata tertib sekolah.</li>
                                        <li>Apabila menemukan kartu ini, harap hubungi Sekretariat PKBM Abu Dzar Al-Ghifari.</li>
                                    </ul>

                                    {{-- Signature Section --}}
                                    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 15px; border-t: 1px solid #E5E7EB; padding-top: 10px;">
                                        <div style="text-align: left; font-size: 8px; color: #6B7280; font-weight: bold;">
                                            Cikarang Barat, {{ date('d-m-Y') }}<br>
                                            Kepala Sekolah PKBM
                                            
                                            <div style="height: 36px; display: flex; align-items: center; position: relative; margin-top: 4px;">
                                                {{-- Digital Validation Badge --}}
                                                <div style="border: 2px solid #EF4444; color: #EF4444; font-size: 7px; font-weight: 900; text-transform: uppercase; padding: 2px 6px; border-radius: 4px; transform: rotate(-8deg); letter-spacing: 1px; font-family: monospace; background-color: rgba(255,255,255,0.9); box-shadow: 0 2px 4px rgba(239, 68, 68, 0.1);">
                                                    VALIDATED
                                                </div>
                                            </div>
                                            <span style="color: #1F2937; font-weight: 800; font-size: 9px; text-transform: uppercase;">Sekretariat PKBM</span>
                                        </div>

                                        {{-- School Logo Icon backing --}}
                                        <div style="width: 44px; height: 44px; opacity: 0.15; color: #1E3A8A;">
                                            <svg style="width: 100%; height: 100%;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                                        </div>
                                    </div>
                                    
                                    {{-- Footer Decorative Bar --}}
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 6px; background-color: #1E3A8A; border-bottom-left-radius: 18px; border-bottom-right-radius: 18px;"></div>
                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- Action Control Bar --}}
                    <div style="display: flex; justify-content: center; margin-top: 20px;" class="no-print">
                        <button onclick="window.print()" style="background-color: #1F2937; color: #ffffff; font-size: 15px; font-weight: 900; padding: 14px 36px; border: none; border-radius: 12px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; align-items: center; gap: 10px;" id="print-btn">
                            <svg style="width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2.5;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096a42.412 42.412 0 00-10.56 0m10.56 0L17.66 18m0 0a2.25 2.25 0 01-2.244 2.077H8.584A2.25 2.25 0 016.34 18m11.318-4.171V7.5m0 0a4.5 4.5 0 00-9 0V13.83m9-6.3L16.235 5.518A2.25 2.25 0 0014.618 4.75H9.382a2.25 2.25 0 00-1.617.768L6.3 7.5m11.318 0l1.41-1.41M6.3 7.5L4.89 6.09"/></svg>
                            Cetak Kartu Pelajar
                        </button>
                    </div>

                    {{-- ==================== DISPLAY PRINT PREVIEW (ONLY WHEN PRINTING) ==================== --}}
                    <div class="print-only" style="display: none; justify-content: center; gap: 30px; background-color: #ffffff; padding: 0; margin: 0; box-sizing: border-box; width: 100%;">
                        
                        {{-- Front Card Copy --}}
                        <div class="print-card" style="position: relative; width: 85.6mm; height: 53.98mm; border-radius: 4mm; box-sizing: border-box; border: 1px solid #1E3A8A; background: linear-gradient(135deg, #1E3A8A 0%, #0F172A 100%); padding: 4mm; color: #ffffff; font-family: sans-serif; overflow: hidden; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                            <div style="display: flex; align-items: center; gap: 2mm; margin-bottom: 2mm; border-bottom: 0.5px solid rgba(255,255,255,0.25); padding-bottom: 2mm;">
                                <div style="width: 7mm; height: 7mm; border-radius: 1.5mm; background-color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; color: #1E3A8A; font-size: 3mm;">
                                    AD
                                </div>
                                <div style="text-align: left;">
                                    <h4 style="margin: 0; font-size: 2.3mm; font-weight: 900; color: #ffffff; text-transform: uppercase;">PKBM Abu Dzar Al-Ghifari</h4>
                                    <span style="font-size: 1.4mm; color: #93C5FD; font-weight: 700; letter-spacing: 0.2mm;">STUDENT ID CARD</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 4mm; align-items: center; justify-content: space-between; height: 32mm;">
                                <div style="width: 19mm; height: 26mm; border-radius: 2mm; overflow: hidden; background-color: rgba(255,255,255,0.1); border: 0.5mm solid #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 1mm 2mm rgba(0,0,0,0.15);">
                                    @if ($document && $document->pas_foto)
                                        <img src="{{ asset('storage/' . $document->pas_foto) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <svg style="width: 10mm; height: 10mm; color: rgba(255,255,255,0.4);" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    @endif
                                </div>
                                <div style="flex: 1; text-align: left; display: flex; flex-direction: column; gap: 1.5mm; color: #ffffff;">
                                    <div>
                                        <span style="font-size: 1.5mm; color: #93C5FD; font-weight: 700; text-transform: uppercase;">Nama Lengkap</span>
                                        <h3 style="margin: 0.3mm 0 0 0; font-size: 2.8mm; font-weight: 900; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 38mm;">
                                            {{ $detail?->nama_lengkap ?? $user->name }}
                                        </h3>
                                    </div>
                                    <div>
                                        <span style="font-size: 1.5mm; color: #93C5FD; font-weight: 700; text-transform: uppercase;">NISN</span>
                                        <h4 style="margin: 0.3mm 0 0 0; font-size: 2.4mm; font-weight: 800; font-family: monospace;">
                                            {{ $detail?->nisn ?? '0098471638' }}
                                        </h4>
                                    </div>
                                    <div>
                                        <span style="font-size: 1.5mm; color: #93C5FD; font-weight: 700; text-transform: uppercase;">Program Jenjang</span>
                                        <h4 style="margin: 0.3mm 0 0 0; font-size: 2.2mm; font-weight: 800; color: #34D399;">
                                            @if($user->jenjang == 'SD') PMC Kids (TK) @elseif($user->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif
                                        </h4>
                                    </div>
                                </div>
                                <div style="width: 11mm; height: 11mm; background-color: #ffffff; border-radius: 1mm; padding: 1mm; box-sizing: border-box; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 100%; height: 100%; color: #0F172A;" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 15h6v6H3v-6zm2 2v2h2v-2H5zm10-2h2v2h-2v-2zm2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm-2-2h2v2h-2v-2zm4-4h2v2h-2v-2zm-2 2h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 1mm; background-color: #10B981;"></div>
                        </div>

                        {{-- Back Card Copy --}}
                        <div class="print-card" style="position: relative; width: 85.6mm; height: 53.98mm; border-radius: 4mm; box-sizing: border-box; border: 1px solid #D1D5DB; background: #ffffff; padding: 4mm; color: #1F2937; font-family: sans-serif; overflow: hidden; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                            <h4 style="margin: 0 0 1.5mm 0; font-size: 2.2mm; font-weight: 900; color: #1F2937; text-transform: uppercase; border-bottom: 0.3mm solid #E5E7EB; padding-bottom: 1mm;">
                                Ketentuan Penggunaan Kartu
                            </h4>
                            <ul style="margin: 0 0 2mm 0; padding-left: 3mm; font-size: 1.6mm; color: #4B5563; text-align: left; line-height: 1.4; font-weight: bold; display: flex; flex-direction: column; gap: 0.6mm;">
                                <li>Kartu ini adalah tanda pengenal resmi PKBM Abu Dzar Al-Ghifari.</li>
                                <li>Kartu wajib dibawa selama berada di lingkungan sekolah / ujian.</li>
                                <li>Penyalahgunaan kartu ini akan dikenakan sanksi tata tertib sekolah.</li>
                                <li>Apabila menemukan kartu ini, harap hubungi Sekretariat PKBM.</li>
                            </ul>
                            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 1.5mm; border-top: 0.3mm solid #E5E7EB; padding-top: 1.5mm;">
                                <div style="text-align: left; font-size: 1.6mm; color: #6B7280; font-weight: bold;">
                                    Cikarang Barat, {{ date('d-m-Y') }}<br>
                                    Kepala Sekolah PKBM
                                    <div style="height: 6mm; display: flex; align-items: center; position: relative; margin-top: 1mm;">
                                        <div style="border: 0.4mm solid #EF4444; color: #EF4444; font-size: 1.3mm; font-weight: 900; text-transform: uppercase; padding: 0.4mm 1mm; border-radius: 0.6mm; transform: rotate(-5deg); background-color: rgba(255,255,255,0.9);">
                                            VALIDATED
                                        </div>
                                    </div>
                                    <span style="color: #1F2937; font-weight: 800; font-size: 1.8mm; text-transform: uppercase;">Sekretariat PKBM</span>
                                </div>
                                <div style="width: 9mm; height: 9mm; opacity: 0.15; color: #1E3A8A;">
                                    <svg style="width: 100%; height: 100%;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                                </div>
                            </div>
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 1mm; background-color: #1E3A8A;"></div>
                        </div>

                    </div>

                @endif

            </div>
        </div>
    </div>

    {{-- CSS Styles for 3D Flippable Card & Print Overrides --}}
    <style>
        /* 3D Flip Mechanics */
        .card-container {
            width: 480px;
            height: 290px;
            perspective: 1000px;
            margin: 0 auto;
        }
        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
            cursor: pointer;
        }
        .card-container:hover .card-inner, .card-container.flipped .card-inner {
            transform: rotateY(180deg);
        }
        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 20px;
            padding: 24px;
            box-sizing: border-box;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        }
        
        /* Front styling (Dark Blue Gradient) */
        .card-front {
            background: linear-gradient(135deg, #1E3A8A 0%, #0F172A 100%);
            border: 1px solid rgba(255,255,255,0.15);
        }
        
        /* Back styling (Clean White card backing) */
        .card-back {
            background-color: #ffffff;
            border: 1px solid #E5E7EB;
            transform: rotateY(180deg);
            color: #1F2937;
        }

        #print-btn:hover {
            background-color: #10B981 !important;
            transform: scale(1.02);
        }

        /* PRINT MEDIA STYLING SPECIFIC FOR PVC CARD RATIO */
        @media print {
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
            }
            /* Hide EVERYTHING except the print preview block */
            nav, header, footer, .no-print, main > div, #print-btn {
                display: none !important;
            }
            
            /* Show print preview block */
            .print-only {
                display: flex !important;
                visibility: visible !important;
                position: absolute !important;
                left: 0 !important;
                top: 50px !important;
                justify-content: center !important;
                gap: 15mm !important;
                background-color: #ffffff !important;
                width: 100% !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .print-card {
                display: block !important;
                float: left !important;
                page-break-inside: avoid !important;
            }
        }
    </style>

    {{-- JS Helper to toggle flip on mobile taps --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inner = document.querySelector('.card-inner');
            if (inner) {
                inner.addEventListener('click', function() {
                    this.parentElement.classList.toggle('flipped');
                });
            }
        });
    </script>
</x-app-layout>
