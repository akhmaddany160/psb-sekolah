<x-app-layout>
    {{-- CSS Kustom untuk menyelaraskan tampilan 100% presisi dengan Figma --}}
    <style>
        .pemberkasan-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
            width: 100%;
        }

        /* Tampilan Mobile & Tablet (Tata letak mengalir berurutan) */
        .doc-item-mobile-title {
            display: block;
        }
        .doc-title-desktop-span {
            display: none;
        }
        .col-4-desktop-container {
            display: contents; /* Biarkan grid mengalir normal di mobile */
        }
        .doc-card-white {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border: none;
            width: 100%;
            transition: all 0.2s ease;
        }

        .doc-card-white.uploaded-preview {
            padding: 0 !important;
            overflow: hidden;
            position: relative;
            display: block !important;
            border: 2px solid #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .doc-card-white.uploaded-preview:hover .preview-image {
            transform: scale(1.05);
        }

        .glass-overlay-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 8px 12px;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 10;
        }

        .glass-overlay-bar .file-info {
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 0;
        }

        .glass-overlay-bar .file-name {
            font-size: 10px;
            font-weight: 700;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 90px;
        }

        .glass-btn-see {
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .glass-btn-see:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        .glass-btn-delete {
            padding: 5px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171 !important;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .glass-btn-delete:hover {
            background: rgba(239, 68, 68, 0.3);
            border-color: rgba(239, 68, 68, 0.4);
            color: #ef4444 !important;
            transform: translateY(-1px);
        }

        /* Dimensi relatif untuk mobile agar pas di layar */
        .ratio-portrait {
            width: 100%;
            max-width: 200px;
            height: 310px;
        }

        .ratio-landscape {
            width: 100%;
            max-width: 320px;
            height: 180px;
        }

        /* Tampilan Desktop (Dimensi PIXEL PRESISI 100% seperti Figma) */
        @media (min-width: 1024px) {
            .pemberkasan-grid {
                grid-template-columns: 180px 180px 180px 320px;
                grid-auto-rows: auto;
                align-items: start;
                justify-content: start;
            }

            .doc-item-mobile-title {
                display: none !important;
            }

            .doc-title-desktop-span {
                display: block !important;
            }

            /* Container khusus untuk Kolom 4 agar KK & NISN Datar Mendekat Rapi */
            .col-4-desktop-container {
                grid-column: 4;
                grid-row: 1 / span 6;
                display: flex !important;
                flex-direction: column;
                gap: 16px; /* Jarak rapat presisi antara KK, NISN, dan Pas Foto */
                width: 100%;
            }

            .col-4-desktop-container .doc-title {
                margin-top: 0 !important;
                margin-bottom: 8px !important;
            }
            
            /* Penempatan Grid Kolom 1, 2, 3 Persis Figma */
            .title-row-1-ijazah-transkrip {
                grid-column: 1 / span 2;
                grid-row: 1;
            }
            .title-row-1-akta {
                grid-column: 3;
                grid-row: 1;
            }

            .card-ijazah {
                grid-column: 1;
                grid-row: 2;
            }
            .card-transkrip {
                grid-column: 2;
                grid-row: 2;
            }
            .card-akta {
                grid-column: 3;
                grid-row: 2;
            }

            .title-row-2-foto {
                grid-column: 1;
                grid-row: 3;
                margin-top: 24px;
            }
            .title-row-2-prestasi {
                grid-column: 2;
                grid-row: 3;
                margin-top: 24px;
            }
            .title-row-2-tahfidz {
                grid-column: 3;
                grid-row: 3;
                margin-top: 24px;
            }

            .card-foto {
                grid-column: 1;
                grid-row: 4;
            }
            .card-prestasi {
                grid-column: 2;
                grid-row: 4;
            }
            .card-tahfidz {
                grid-column: 3;
                grid-row: 4;
            }

            /* Dimensi Pixel Absolut pada Desktop */
            .ratio-portrait {
                width: 180px !important;
                height: 310px !important;
            }

            .ratio-landscape {
                width: 320px !important;
                height: 180px !important;
            }
        }

        /* Label di luar kartu (di atas background abu-abu) */
        .doc-title {
            font-size: 20px;
            font-weight: 800;
            font-style: italic;
            color: #000000;
            text-align: left;
            font-family: sans-serif;
            margin-bottom: 8px;
        }
    </style>

    <div style="width: 100%; padding: 40px 0; background-color: #ffffff; min-height: 100vh; font-family: sans-serif;">
        <div style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">
            
            {{-- Alert Notifikasi --}}
            @if (session('success'))
                <div style="margin-bottom: 24px; padding: 16px; background-color: #d1e7dd; color: #0f5132; border-radius: 12px; font-weight: bold; display: flex; align-items: center; gap: 10px; border: 1px solid #badbcc;">
                    <svg style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div style="margin-bottom: 24px; padding: 16px; background-color: #f8d7da; color: #842029; border-radius: 12px; font-weight: bold; display: flex; align-items: center; gap: 10px; border: 1px solid #f5c2c7;">
                    <svg style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div style="margin-bottom: 24px; padding: 16px; background-color: #f8d7da; color: #842029; border-radius: 12px; font-weight: bold; border: 1px solid #f5c2c7;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                // Definisikan ikon kustom
                $icons = [
                    'ijazah' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
                    'transkrip_nilai' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
                    'akta_kelahiran' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                    'kartu_keluarga' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
                    'ktp_ortu' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>',
                    'nisn' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>',
                    'sertifikat_prestasi' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>',
                    'sertifikat_tahfidz' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>',
                    'pas_foto' => '<svg class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                ];
            @endphp

            {{-- Kontainer Abu-abu Khas --}}
            <div style="background-color: #D9D9D9; border-radius: 30px; padding: 40px; color: #000000; box-sizing: border-box; width: fit-content; min-width: 100%; margin: 0 auto;">
                
                {{-- Grid Dokumen yang Persis Sesuai Figma --}}
                <div class="pemberkasan-grid">
                    
                    {{-- ==================== KOLOM 1, 2, 3 (Grid Bebas) ==================== --}}
                    
                    {{-- Judul Desktop Spanned: Ijazah dan Transkrip Nilai (Col 1 & 2) --}}
                    <div class="doc-title doc-title-desktop-span title-row-1-ijazah-transkrip">
                        Ijazah dan Transkrip Nilai
                    </div>
                    
                    {{-- Ijazah Card (Col 1) --}}
                    <div class="doc-item card-ijazah">
                        <div class="doc-title doc-item-mobile-title">Ijazah Terakhir</div>
                        <div class="doc-card-white ratio-portrait" style="{{ $document && $document->ijazah ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->ijazah)
                                @php 
                                    $fileName = $document->ijazah; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Ijazah" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 10px 14px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 5px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 75px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'ijazah') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 14px !important; height: 14px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 20px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-3 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            {!! $icons['ijazah'] !!}
                                            <div class="upload-text-group">
                                                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                <span class="text-[8px] text-slate-400 block mt-1">PDF/Gambar, 2MB</span>
                                            </div>
                                            <input type="file" name="ijazah" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 20px 20px 20px; box-sizing: border-box;">
                                    <button class="w-full py-2 bg-slate-100 text-slate-400 text-[11px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Transkrip Card (Col 2) --}}
                    <div class="doc-item card-transkrip">
                        <div class="doc-title doc-item-mobile-title">Transkrip Nilai</div>
                        <div class="doc-card-white ratio-portrait" style="{{ $document && $document->transkrip_nilai ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->transkrip_nilai)
                                @php 
                                    $fileName = $document->transkrip_nilai; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Transkrip Nilai" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 10px 14px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 5px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 75px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'transkrip_nilai') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 14px !important; height: 14px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 20px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-3 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            {!! $icons['transkrip_nilai'] !!}
                                            <div class="upload-text-group">
                                                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                <span class="text-[8px] text-slate-400 block mt-1">PDF/Gambar, 2MB</span>
                                            </div>
                                            <input type="file" name="transkrip_nilai" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 20px 20px 20px; box-sizing: border-box;">
                                    <button class="w-full py-2 bg-slate-100 text-slate-400 text-[11px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
                    </div>
 
                    {{-- Judul Desktop: Akta Kelahiran (Col 3) --}}
                    <div class="doc-title doc-title-desktop-span title-row-1-akta">
                        Akta Kelahiran
                    </div>
                    
                    {{-- Akta Card (Col 3) --}}
                    <div class="doc-item card-akta">
                        <div class="doc-title doc-item-mobile-title">Akta Kelahiran</div>
                        <div class="doc-card-white ratio-portrait" style="{{ $document && $document->akta_kelahiran ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->akta_kelahiran)
                                @php 
                                    $fileName = $document->akta_kelahiran; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Akta Kelahiran" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 10px 14px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 5px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 75px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'akta_kelahiran') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 14px !important; height: 14px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 20px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-3 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            {!! $icons['akta_kelahiran'] !!}
                                            <div class="upload-text-group">
                                                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                <span class="text-[8px] text-slate-400 block mt-1">PDF/Gambar, 2MB</span>
                                            </div>
                                            <input type="file" name="akta_kelahiran" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 20px 20px 20px; box-sizing: border-box;">
                                    <button class="w-full py-2 bg-slate-100 text-slate-400 text-[11px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
                    </div>
 
                    {{-- Judul Desktop: Pas Photo 3x4 (Col 1) --}}
                    <div class="doc-title doc-title-desktop-span title-row-2-foto">
                        Pas Photo 3x4
                    </div>
                    
                    {{-- Pas Photo 3x4 Card (Col 1) --}}
                    <div class="doc-item card-foto">
                        <div class="doc-title doc-item-mobile-title">Pas Photo 3x4</div>
                        <div class="doc-card-white ratio-portrait" style="{{ $document && $document->pas_foto ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->pas_foto)
                                @php 
                                    $fileName = $document->pas_foto; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Pas Photo 3x4" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 10px 14px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 5px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 75px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'pas_foto') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 14px !important; height: 14px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 20px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-3 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            {!! $icons['pas_foto'] !!}
                                            <div class="upload-text-group">
                                                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                <span class="text-[8px] text-slate-400 block mt-1">Gambar (JPG/PNG), 2MB</span>
                                            </div>
                                            <input type="file" name="pas_foto" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 20px 20px 20px; box-sizing: border-box;">
                                    <button class="w-full py-2 bg-slate-100 text-slate-400 text-[11px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
                    </div>
 
                    {{-- Judul Desktop: Sertifikat Prestasi (Col 2) --}}
                    <div class="doc-title doc-title-desktop-span title-row-2-prestasi">
                        Sertifikat Prestasi
                    </div>
                    
                    {{-- Prestasi Card (Col 2) --}}
                    <div class="doc-item card-prestasi">
                        <div class="doc-title doc-item-mobile-title">Sertifikat Prestasi</div>
                        <div class="doc-card-white ratio-portrait" style="{{ $document && $document->sertifikat_prestasi ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->sertifikat_prestasi)
                                @php 
                                    $fileName = $document->sertifikat_prestasi; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Sertifikat Prestasi" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 10px 14px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 5px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 75px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'sertifikat_prestasi') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 14px !important; height: 14px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 20px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-3 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            {!! $icons['sertifikat_prestasi'] !!}
                                            <div class="upload-text-group">
                                                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                <span class="text-[8px] text-slate-400 block mt-1">PDF/Gambar, 2MB</span>
                                            </div>
                                            <input type="file" name="sertifikat_prestasi" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 20px 20px 20px; box-sizing: border-box;">
                                    <button class="w-full py-2 bg-slate-100 text-slate-400 text-[11px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
                    </div>
 
                    {{-- Judul Desktop: Sertifikat Tahfidz (Col 3) --}}
                    <div class="doc-title doc-title-desktop-span title-row-2-tahfidz">
                        Sertifikat Tahfidz
                    </div>
                    
                    {{-- Tahfidz Card (Col 3) --}}
                    <div class="doc-item card-tahfidz">
                        <div class="doc-title doc-item-mobile-title">Sertifikat Tahfidz</div>
                        <div class="doc-card-white ratio-portrait" style="{{ $document && $document->sertifikat_tahfidz ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->sertifikat_tahfidz)
                                @php 
                                    $fileName = $document->sertifikat_tahfidz; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Sertifikat Tahfidz" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 10px 14px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 5px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 75px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'sertifikat_tahfidz') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 14px !important; height: 14px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 20px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-3 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            {!! $icons['sertifikat_tahfidz'] !!}
                                            <div class="upload-text-group">
                                                <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                <span class="text-[8px] text-slate-400 block mt-1">PDF/Gambar, 2MB</span>
                                            </div>
                                            <input type="file" name="sertifikat_tahfidz" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 20px 20px 20px; box-sizing: border-box;">
                                    <button class="w-full py-2 bg-slate-100 text-slate-400 text-[11px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
                    </div>
 
 
                    {{-- ==================== KOLOM 4 (WADAH TEGAK MANDIRI) ==================== --}}
                    
                    {{-- Container Kolom 4 Mandiri: Kartu Keluarga, NISN, KTP --}}
                    <div class="col-4-desktop-container">
                        
                        {{-- Kartu Keluarga --}}
                        <div class="doc-title doc-title-desktop-span title-row-1-kk">
                            Kartu Keluarga
                        </div>
                        <div class="doc-card-white ratio-landscape" style="{{ $document && $document->kartu_keluarga ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->kartu_keluarga)
                                @php 
                                    $fileName = $document->kartu_keluarga; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="Kartu Keluarga" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 6px 12px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 4px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 140px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'kartu_keluarga') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 12px !important; height: 12px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 16px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-2 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            <div style="display: flex; align-items: center; gap: 14px; width: 100%; height: 100%; box-sizing: border-box; justify-content: center;">
                                                <div style="flex-shrink: 0;">
                                                    {!! $icons['kartu_keluarga'] !!}
                                                </div>
                                                <div class="upload-text-group" style="display: flex; flex-direction: column; gap: 2px; text-align: left;">
                                                    <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                    <span class="text-[8px] text-slate-400 block">PDF/Gambar, 2MB</span>
                                                </div>
                                            </div>
                                            <input type="file" name="kartu_keluarga" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 16px 16px 16px; box-sizing: border-box;">
                                    <button class="w-full py-1.5 bg-slate-100 text-slate-400 text-[10px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
 
                        {{-- NISN --}}
                        <div class="doc-title doc-title-desktop-span title-row-2-nisn">
                            NISN
                        </div>
                        <div class="doc-card-white ratio-landscape" style="{{ $document && $document->nisn ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->nisn)
                                @php 
                                    $fileName = $document->nisn; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="NISN" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 6px 12px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 4px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 140px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'nisn') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 12px !important; height: 12px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 16px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-2 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            <div style="display: flex; align-items: center; gap: 14px; width: 100%; height: 100%; box-sizing: border-box; justify-content: center;">
                                                <div style="flex-shrink: 0;">
                                                    {!! $icons['nisn'] !!}
                                                </div>
                                                <div class="upload-text-group" style="display: flex; flex-direction: column; gap: 2px; text-align: left;">
                                                    <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                    <span class="text-[8px] text-slate-400 block">PDF/Gambar, 2MB</span>
                                                </div>
                                            </div>
                                            <input type="file" name="nisn" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 16px 16px 16px; box-sizing: border-box;">
                                    <button class="w-full py-1.5 bg-slate-100 text-slate-400 text-[10px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>

                        {{-- KTP Orang Tua/ Wali --}}
                        <div class="doc-title doc-title-desktop-span title-row-3-ktp">
                            KTP Orang Tua/ Wali
                        </div>
                        <div class="doc-card-white ratio-landscape" style="{{ $document && $document->ktp_ortu ? 'padding: 0 !important; overflow: hidden !important; position: relative !important; display: block !important; border: 2px solid #ffffff !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;' : '' }}">
                            @if ($document && $document->ktp_ortu)
                                @php 
                                    $fileName = $document->ktp_ortu; 
                                    $ext = pathinfo($fileName, PATHINFO_EXTENSION); 
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if ($isImage)
                                    <img src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" style="width: 100% !important; height: 100% !important; object-fit: cover !important; display: block !important;" alt="KTP Orang Tua/ Wali" />
                                @else
                                    <iframe src="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}#toolbar=0&navpanes=0&scrollbar=0" style="width: 100% !important; height: 100% !important; border: none !important; pointer-events: none !important; display: block !important;" frameborder="0"></iframe>
                                @endif
                                <div style="position: absolute !important; bottom: 0 !important; left: 0 !important; right: 0 !important; padding: 6px 12px !important; background: rgba(15, 23, 42, 0.88) !important; backdrop-filter: blur(12px) !important; -webkit-backdrop-filter: blur(12px) !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; display: flex !important; align-items: center !important; justify-content: space-between !important; z-index: 10 !important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important; min-width: 0 !important;">
                                        <span style="font-size: 8px !important; font-weight: 800 !important; padding: 2px 4px !important; border-radius: 4px !important; color: #fff !important; background: {{ strtolower($ext) === 'pdf' ? '#ef4444' : '#10b981' }} !important; text-transform: uppercase !important;">{{ $ext }}</span>
                                        <span style="font-size: 10px !important; font-weight: 700 !important; color: #ffffff !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; max-width: 140px !important;" title="{{ $fileName }}">{{ $fileName }}</span>
                                    </div>
                                    <div style="display: flex !important; align-items: center !important; gap: 6px !important;">
                                        <a href="{{ asset('storage/documents/' . auth()->id() . '/' . $fileName) }}" target="_blank" style="padding: 4px 10px !important; background: rgba(255, 255, 255, 0.15) !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; color: #ffffff !important; border-radius: 6px !important; font-size: 10px !important; font-weight: 800 !important; text-decoration: none !important; display: inline-block !important; transition: all 0.2s ease !important;">Lihat</a>
                                        <form method="POST" action="{{ route('student.pemberkasan.destroy', 'ktp_ortu') }}" style="margin: 0 !important; display: inline !important;">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus berkas ini?')" style="padding: 5px !important; background: rgba(239, 68, 68, 0.15) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-radius: 6px !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; transition: all 0.2s ease !important;" title="Hapus Berkas">
                                                <svg style="width: 12px !important; height: 12px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; width: 100%; height: 100%; box-sizing: border-box; padding: 16px;">
                                    <form method="POST" action="{{ route('student.pemberkasan.store') }}" enctype="multipart/form-data" class="w-full h-full" style="margin: 0; display: flex; align-items: center; justify-content: center;">
                                        @csrf
                                        <label class="upload-area-wrapper flex flex-col items-center justify-center border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-xl p-2 cursor-pointer bg-slate-50/50 hover:bg-emerald-50/5 transition-all duration-200 group text-center w-full h-full" style="box-sizing: border-box; margin: 0;">
                                            <div style="display: flex; align-items: center; gap: 14px; width: 100%; height: 100%; box-sizing: border-box; justify-content: center;">
                                                <div style="flex-shrink: 0;">
                                                    {!! $icons['ktp_ortu'] !!}
                                                </div>
                                                <div class="upload-text-group" style="display: flex; flex-direction: column; gap: 2px; text-align: left;">
                                                    <span class="text-xs font-bold text-slate-600 group-hover:text-emerald-600 transition-colors block">Pilih Berkas</span>
                                                    <span class="text-[8px] text-slate-400 block">PDF/Gambar, 2MB</span>
                                                </div>
                                            </div>
                                            <input type="file" name="ktp_ortu" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                                <div class="w-full" style="padding: 0 16px 16px 16px; box-sizing: border-box;">
                                    <button class="w-full py-1.5 bg-slate-100 text-slate-400 text-[10px] font-bold rounded-xl border border-slate-200 cursor-not-allowed text-center" disabled>Belum Diunggah</button>
                                </div>
                            @endif
                        </div>
 
                    </div>

                </div>



            </div>

        </div>
    </div>
</x-app-layout>
