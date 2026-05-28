<x-app-layout>
    <div style="width: 100%; padding: 40px 0; background-color: #ffffff; min-height: 100vh; font-family: sans-serif;">
        <div style="width: 100%; max-width: 1000px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">
            
            {{-- Header & Timer Panel --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background-color: #1F2937; color: #ffffff; padding: 20px 30px; border-radius: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); flex-wrap: wrap; gap: 16px;">
                <div>
                    <h2 style="font-size: 20px; font-weight: 900; font-style: italic; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Test Seleksi Online</h2>
                    <p style="font-size: 13px; color: #9CA3AF; margin: 4px 0 0 0; font-weight: 700;">Jenjang Program: 
                        <span style="color: #34D399; font-weight: 900;">
                            @if($user->jenjang == 'SD') PMC Kids (TK) @elseif($user->jenjang == 'SMP') PMC Home School (SD) @else Al-Bayan School (SMP/SMA) @endif
                        </span>
                    </p>
                </div>
                
                {{-- Countdown Timer Visual --}}
                <div style="display: flex; align-items: center; gap: 12px; background-color: rgba(255, 255, 255, 0.1); padding: 10px 20px; border-radius: 12px;">
                    <svg style="width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2.5; color: #F59E0B;" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div style="font-size: 18px; font-weight: 900; font-family: monospace; letter-spacing: 1px; color: #F59E0B;" id="timer-display">15:00</div>
                </div>
            </div>

            @if ($errors->any())
                <div style="margin-bottom: 24px; padding: 16px; background-color: #f8d7da; color: #842029; border-radius: 12px; font-weight: bold; border: 1px solid #f5c2c7;">
                    <p style="margin: 0 0 8px 0;">Mohon jawab semua pertanyaan sebelum mengirimkan ujian:</p>
                    <ul style="margin: 0; padding-left: 20px; font-size: 14px; font-weight: normal;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Form Container (Gray Theme matching Biodata) --}}
            <div style="background-color: #D9D9D9; border-radius: 30px; padding: 40px; color: #000000; box-sizing: border-box; width: 100%;">
                <form id="test-form" method="POST" action="{{ route('student.test.submit') }}">
                    @csrf

                    @foreach($questions as $index => $q)
                        <div style="background-color: #ffffff; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); box-sizing: border-box;">
                            
                            {{-- Soal Header --}}
                            <div style="display: flex; gap: 14px; align-items: flex-start; margin-bottom: 20px;">
                                <span style="background-color: #1F2937; color: #ffffff; font-size: 14px; font-weight: 900; padding: 6px 14px; border-radius: 10px; flex-shrink: 0;">
                                    Soal {{ $index + 1 }}
                                </span>
                                <h3 style="font-size: 17px; font-weight: 800; line-height: 1.6; color: #1F2937; margin: 0;">
                                    {{ $q['text'] }}
                                </h3>
                            </div>

                            {{-- Pilihan Jawaban (Custom Radio Cards) --}}
                            <div style="display: flex; flex-direction: column; gap: 12px; width: 100%;">
                                @foreach($q['options'] as $key => $optionText)
                                    <label class="choice-card" style="display: flex; align-items: center; gap: 16px; border: 2px solid #E5E7EB; border-radius: 14px; padding: 16px 20px; cursor: pointer; transition: all 0.2s ease; box-sizing: border-box; width: 100%;">
                                        <input type="radio" name="q{{ $q['id'] }}" value="{{ $key }}" class="radio-input" style="display: none;" required {{ old('q'.$q['id']) == $key ? 'checked' : '' }}>
                                        
                                        <div class="radio-bullet" style="width: 22px; height: 22px; border-radius: 50%; border: 2.5px solid #D1D5DB; display: flex; align-items: center; justify-content: center; background-color: #ffffff; flex-shrink: 0; transition: all 0.2s ease;">
                                            <div class="bullet-inner" style="width: 10px; height: 10px; border-radius: 50%; background-color: transparent; transition: all 0.2s ease;"></div>
                                        </div>
                                        
                                        <span style="font-size: 15px; font-weight: 700; color: #374151;">
                                            <span style="color: #9CA3AF; margin-right: 8px;">{{ $key }}.</span> {{ $optionText }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                        </div>
                    @endforeach

                    {{-- Action Footer --}}
                    <div style="display: flex; justify-content: flex-end; margin-top: 40px;">
                        <button type="button" id="submit-btn" style="background-color: #1F2937; color: #ffffff; font-size: 18px; font-weight: 900; padding: 16px 48px; border: none; border-radius: 12px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);">
                            Kirim Jawaban
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    {{-- Interactive CSS Styles --}}
    <style>
        .choice-card:hover {
            border-color: #10B981 !important;
            background-color: #ECFDF5 !important;
        }
        .choice-card.selected {
            border-color: #10B981 !important;
            background-color: #D1FAE5 !important;
        }
        .choice-card.selected .radio-bullet {
            border-color: #10B981 !important;
        }
        .choice-card.selected .bullet-inner {
            background-color: #10B981 !important;
        }
        #submit-btn:hover {
            background-color: #10B981 !important;
            transform: scale(1.02);
        }
    </style>

    {{-- Script for Countdown and Interactive Selection --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Logic for Custom Radio Selection Visuals
            const choiceCards = document.querySelectorAll('.choice-card');
            
            function updateRadioVisuals() {
                choiceCards.forEach(card => {
                    const input = card.querySelector('input[type="radio"]');
                    if (input.checked) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
            }

            choiceCards.forEach(card => {
                card.addEventListener('click', function() {
                    const input = this.querySelector('input[type="radio"]');
                    input.checked = true;
                    updateRadioVisuals();
                });
            });

            // Run visual update on load to handle old input values
            updateRadioVisuals();

            // 2. Countdown Timer Logic (15 Minutes)
            let totalSeconds = 15 * 60;
            const timerDisplay = document.getElementById('timer-display');
            const form = document.getElementById('test-form');

            const countdownInterval = setInterval(function() {
                totalSeconds--;

                if (totalSeconds <= 0) {
                    clearInterval(countdownInterval);
                    timerDisplay.textContent = "00:00";
                    alert("Waktu ujian Anda telah habis! Ujian Anda akan otomatis dikirimkan ke sistem.");
                    form.submit(); // Auto submit on timeout
                    return;
                }

                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                
                const paddedMinutes = String(minutes).padStart(2, '0');
                const paddedSeconds = String(seconds).padStart(2, '0');
                
                timerDisplay.textContent = `${paddedMinutes}:${paddedSeconds}`;

                // Warning state when less than 1 minute remains
                if (totalSeconds < 60) {
                    timerDisplay.style.color = "#EF4444";
                }
            }, 1000);

            // 3. Confirmation Dialog on Manual Submit
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.addEventListener('click', function(e) {
                
                // Cek apakah semua soal telah diisi
                const questionsCount = {{ count($questions) }};
                const answeredCount = document.querySelectorAll('input[type="radio"]:checked').length;
                
                if (answeredCount < questionsCount) {
                    alert("Harap jawab semua pertanyaan terlebih dahulu sebelum mengirimkan jawaban Anda!");
                    return;
                }

                if (confirm("Apakah Anda yakin ingin menyelesaikan ujian ini? Setelah dikirim, jawaban Anda tidak dapat diubah kembali.")) {
                    clearInterval(countdownInterval); // stop timer
                    form.submit();
                }
            });

        });
    </script>
</x-app-layout>
