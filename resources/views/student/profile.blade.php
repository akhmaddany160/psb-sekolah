<x-app-layout>
    <div style="width: 100%; padding: 40px 0; background-color: #ffffff; min-height: 100vh; font-family: sans-serif;">
        <div style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">
            
            @if (session('success'))
                <div style="margin-bottom: 24px; padding: 16px; background-color: #d1e7dd; color: #0f5132; border-radius: 12px; font-weight: bold; border: 1px solid #badbcc;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="margin-bottom: 24px; padding: 16px; background-color: #f8d7da; color: #842029; border-radius: 12px; font-weight: bold; border: 1px solid #f5c2c7;">
                    <p style="margin: 0 0 8px 0; font-size: 16px;">Mohon periksa kembali isian Anda:</p>
                    <ul style="margin: 0; padding-left: 20px; font-size: 14px; font-weight: normal;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $student = $detail instanceof \Illuminate\Support\Collection ? $detail->first() : $detail;
                
                function splitDateToFields($dateString) {
                    if (empty($dateString)) return ['d' => '', 'm' => '', 'y' => ''];
                    $time = strtotime($dateString);
                    if (!$time) return ['d' => '', 'm' => '', 'y' => ''];
                    return [
                        'd' => date('d', $time),
                        'm' => date('m', $time),
                        'y' => date('Y', $time)
                    ];
                }

                $student_birth = splitDateToFields($student->tanggal_lahir ?? '');
                $ayah_birth = splitDateToFields($student->tanggal_lahir_ayah ?? '');
                $ibu_birth = splitDateToFields($student->tanggal_lahir_ibu ?? '');

                $siswa_date = [
                    'd' => old('birth_day', $student_birth['d']),
                    'm' => old('birth_month', $student_birth['m']),
                    'y' => old('birth_year', $student_birth['y']),
                ];
                $ayah_date = [
                    'd' => old('ayah_birth_day', $ayah_birth['d']),
                    'm' => old('ayah_birth_month', $ayah_birth['m']),
                    'y' => old('ayah_birth_year', $ayah_birth['y']),
                ];
                $ibu_date = [
                    'd' => old('ibu_birth_day', $ibu_birth['d']),
                    'm' => old('ibu_birth_month', $ibu_birth['m']),
                    'y' => old('ibu_birth_year', $ibu_birth['y']),
                ];
            @endphp

            <div style="background-color: #D9D9D9; border-radius: 30px; padding: 40px; color: #000000; box-sizing: border-box; width: 100%;">
                <form method="POST" action="{{ route('biodata.store') }}">
                    @csrf

                    <div style="margin-bottom: 40px;">
                        <h3 style="font-size: 24px; font-weight: 900; font-style: italic; margin-bottom: 24px; margin-top: 0;">A. Data Siswa</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('nama_lengkap', $student->nama_lengkap ?? '') }}" required autofocus>
                                <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-1" />
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; align-items: flex-end; width: 100%; box-sizing: border-box;">
                                <div style="flex: 4; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('tempat_lahir', $student->tempat_lahir ?? '') }}" required>
                                </div>
                                <div style="flex: 4; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Tanggal Lahir</label>
                                    <div style="display: flex; gap: 12px; width: 100%;">
                                        
                                        <select name="birth_day" style="flex: 0.5; min-width: 0; text-align: center; padding: 14px 0 14px 12px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>D</option>
                                            @for ($d = 1; $d <= 31; $d++)
                                                @php $val = sprintf('%02d', $d); @endphp
                                                <option value="{{ $val }}" {{ old('birth_day', $siswa_date['d']) == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        </select>

                                        <select name="birth_month" style="flex: 0.5; min-width: 0; text-align: center; padding: 14px 0 14px 10px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>M</option>
                                            @for ($m = 1; $m <= 12; $m++)
                                                @php $val = sprintf('%02d', $m); @endphp
                                                <option value="{{ $val }}" {{ old('birth_month', $siswa_date['m']) == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        </select>

                                        <select name="birth_year" style="flex: 0.8; min-width: 0; text-align: center; padding: 14px 0 14px 8px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>Y</option>
                                            @for ($y = date('Y'); $y >= date('Y') - 40; $y--)
                                                <option value="{{ $y }}" {{ old('birth_year', $siswa_date['y']) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>
                                <div style="flex: 3; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box; -webkit-appearance: select; appearance: select; cursor: pointer;" required>
                                        <option value=""></option>
                                        <option value="L" {{ (old('jenis_kelamin', $student->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ (old('jenis_kelamin', $student->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; width: 100%; box-sizing: border-box;">
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">NIK(Otomatis)</label>
                                    <input type="text" name="nik" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('nik', $student->nik ?? '') }}">
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">NISN(Otomatis)</label>
                                    <input type="text" name="nisn" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('nisn', $student->nisn ?? '') }}">
                                </div>
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; width: 100%; box-sizing: border-box;">
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nomor Whatsapp(Otomatis)</label>
                                    <div style="position: relative; display: flex; align-items: center; width: 100%;">
                                        <span style="position: absolute; left: 16px; font-size: 16px; font-weight: 800;">+62</span>
                                        <input type="text" name="no_wa" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px 14px 55px; font-size: 16px; box-sizing: border-box; font-weight: 700;" value="{{ old('no_wa', str_replace('+62', '', $student->no_wa ?? '')) }}">
                                    </div>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('asal_sekolah', $student->asal_sekolah ?? '') }}">
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Alamat Rumah</label>
                                <textarea name="alamat" rows="2" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box; resize: none;">{{ old('alamat', $student->alamat ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom: 40px;">
                        <h3 style="font-size: 24px; font-weight: 900; font-style: italic; margin-bottom: 24px;">B. Data Orang Tua</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nama Lengkap Ayah</label>
                                <input type="text" name="nama_ayah" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('nama_ayah', $student->nama_ayah ?? '') }}">
                            </div>

                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nama Lengkap Ibu</label>
                                <input type="text" name="nama_ibu" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('nama_ibu', $student->nama_ibu ?? '') }}">
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; width: 100%; box-sizing: border-box;">
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Tanggal Lahir Ayah</label>
                                    <div style="display: flex; gap: 12px; width: 100%;">
                                        <select name="ayah_birth_day" style="flex: 0.5; min-width: 0; text-align: center; padding: 14px 0 14px 12px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>D</option>
                                            @for ($d = 1; $d <= 31; $d++)
                                                @php $val = sprintf('%02d', $d); @endphp
                                                <option value="{{ $val }}" {{ old('ayah_birth_day', $ayah_date['d']) == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        </select>

                                        <select name="ayah_birth_month" style="flex: 0.5; min-width: 0; text-align: center; padding: 14px 0 14px 10px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>M</option>
                                            @for ($m = 1; $m <= 12; $m++)
                                                @php $val = sprintf('%02d', $m); @endphp
                                                <option value="{{ $val }}" {{ old('ayah_birth_month', $ayah_date['m']) == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        </select>

                                        <select name="ayah_birth_year" style="flex: 0.8; min-width: 0; text-align: center; padding: 14px 0 14px 8px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>Y</option>
                                            @for ($y = date('Y'); $y >= date('Y') - 80; $y--)
                                                <option value="{{ $y }}" {{ old('ayah_birth_year', $ayah_date['y']) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Tanggal Lahir Ibu</label>
                                    <div style="display: flex; gap: 12px; width: 100%;">
                                        <select name="ibu_birth_day" style="flex: 0.5; min-width: 0; text-align: center; padding: 14px 0 14px 12px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>D</option>
                                            @for ($d = 1; $d <= 31; $d++)
                                                @php $val = sprintf('%02d', $d); @endphp
                                                <option value="{{ $val }}" {{ old('ibu_birth_day', $ibu_date['d']) == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        </select>

                                        <select name="ibu_birth_month" style="flex: 0.5; min-width: 0; text-align: center; padding: 14px 0 14px 10px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>M</option>
                                            @for ($m = 1; $m <= 12; $m++)
                                                @php $val = sprintf('%02d', $m); @endphp
                                                <option value="{{ $val }}" {{ old('ibu_birth_month', $ibu_date['m']) == $val ? 'selected' : '' }}>{{ $val }}</option>
                                            @endfor
                                        </select>

                                        <select name="ibu_birth_year" style="flex: 0.8; min-width: 0; text-align: center; padding: 14px 0 14px 8px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; background-color: white; cursor: pointer; -webkit-appearance: select; appearance: select;" required>
                                            <option value="" disabled selected hidden>Y</option>
                                            @for ($y = date('Y'); $y >= date('Y') - 80; $y--)
                                                <option value="{{ $y }}" {{ old('ibu_birth_year', $ibu_date['y']) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Alamat Orang Tua</label>
                                <textarea name="alamat_ortu" rows="2" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box; resize: none;">{{ old('alamat_ortu', $student->alamat_ortu ?? '') }}</textarea>
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; width: 100%; box-sizing: border-box;">
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nomor Whatsapp(Otomatis)</label>
                                    <div style="position: relative; display: flex; align-items: center; width: 100%;">
                                        <span style="position: absolute; left: 16px; font-size: 16px; font-weight: 800;">+62</span>
                                        <input type="text" name="no_wa_ortu" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px 14px 55px; font-size: 16px; box-sizing: border-box; font-weight: 700;" value="{{ old('no_wa_ortu', str_replace('+62', '', $student->no_wa_ortu ?? '')) }}">
                                    </div>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('pekerjaan_ayah', $student->pekerjaan_ayah ?? '') }}">
                                </div>
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; width: 100%; box-sizing: border-box;">
                                <div style="flex: 1; min-width: 0; visibility: hidden;"></div>
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('pekerjaan_ibu', $student->pekerjaan_ibu ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <h3 style="font-size: 24px; font-weight: 900; font-style: italic; margin-bottom: 24px;">C. Data Wali(Opsional)</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nama Lengkap Wali</label>
                                <input type="text" name="nama_wali" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('nama_wali', $student->nama_wali ?? '') }}">
                            </div>

                            <div style="display: flex; gap: 24px; flex-wrap: nowrap; width: 100%; box-sizing: border-box;">
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Nomor Whatsapp</label>
                                    <div style="position: relative; display: flex; align-items: center; width: 100%;">
                                        <span style="position: absolute; left: 16px; font-size: 16px; font-weight: 800;">+62</span>
                                        <input type="text" name="no_wa_wali" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px 14px 55px; font-size: 16px; box-sizing: border-box; font-weight: 700;" value="{{ old('no_wa_wali', str_replace('+62', '', $student->no_wa_wali ?? '')) }}">
                                    </div>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Pekerjaan</label>
                                    <input type="text" name="pekerjaan_wali" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box;" value="{{ old('pekerjaan_wali', $student->pekerjaan_wali ?? '') }}">
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 16px; font-weight: 700; margin-bottom: 8px;">Alamat</label>
                                <textarea name="alamat_wali" rows="2" style="width: 100%; background-color: #ffffff; border: none; border-radius: 12px; padding: 14px 18px; font-size: 16px; box-sizing: border-box; resize: none;">{{ old('alamat_wali', $student->alamat_wali ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 40px;">
                        <button type="submit" style="background-color: #1F2937; color: #ffffff; font-size: 18px; font-weight: 900; padding: 16px 48px; border: none; border-radius: 12px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px;">
                            Simpan Biodata
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>