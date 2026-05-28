@php
    $user = Auth::user();
    $hasJenjang = !empty($user->jenjang);
    $hasBiodata = $user->studentDetail()->exists();
    $hasPemberkasan = $user->studentDocument()->exists();
    $studentTest = $user->studentTest;
    $hasTest = $studentTest && $studentTest->status !== 'BELUM_TES';
    $isLulus = $studentTest && $studentTest->status === 'LULUS';
@endphp

<nav class="w-80 bg-white border-r border-gray-200 min-h-screen flex flex-col shadow-sm">
    <div class="p-8">
        <div class="bg-gray-50 h-24 w-full rounded-lg flex items-center justify-center text-gray-400 italic text-xs border border-dashed border-gray-200">
            Logo Sekolah
        </div>
    </div>

    <div class="px-6 flex-1 space-y-3">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block w-full py-3 text-center border rounded-md">
            {{ __('Jenjang Sekolah') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('student.profile.edit')" :active="request()->routeIs('student.profile.edit')" class="block w-full py-3 text-center border rounded-md">
            {{ __('Biodata') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('student.pemberkasan.edit')" :active="request()->routeIs('student.pemberkasan.edit')" class="block w-full py-3 text-center border rounded-md">
            {{ __('Pemberkasan') }}
        </x-responsive-nav-link>

        {{-- Pembayaran Formulir --}}
        <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md opacity-60">
            {{ __('Pembayaran Formulir') }}
        </x-responsive-nav-link>

        {{-- Test Seleksi --}}
        @if($hasJenjang)
            <x-responsive-nav-link :href="$hasTest ? route('student.test.results') : route('student.test.show')" :active="request()->routeIs('student.test.show')" class="block w-full py-3 text-center border rounded-md">
                {{ __('Test Seleksi') }}
            </x-responsive-nav-link>
        @else
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md opacity-60" onclick="alert('Silakan pilih jenjang sekolah terlebih dahulu di menu Jenjang Sekolah.')">
                {{ __('Test Seleksi') }}
            </x-responsive-nav-link>
        @endif

        {{-- Hasil Test Seleksi --}}
        @if($hasTest)
            <x-responsive-nav-link :href="route('student.test.results')" :active="request()->routeIs('student.test.results')" class="block w-full py-3 text-center border rounded-md">
                {{ __('Hasil Test Seleksi') }}
            </x-responsive-nav-link>
        @else
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md opacity-60" onclick="alert('Hasil seleksi belum tersedia. Silakan ikuti Test Seleksi terlebih dahulu.')">
                {{ __('Hasil Test Seleksi') }}
            </x-responsive-nav-link>
        @endif

        {{-- Pembayaran Daftar Ulang --}}
        @if($isLulus)
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md">
                {{ __('Pembayaran Daftar Ulang') }}
            </x-responsive-nav-link>
        @else
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md opacity-60" onclick="alert('Tahap Pembayaran Daftar Ulang hanya terbuka jika Anda dinyatakan LULUS ujian seleksi.')">
                {{ __('Pembayaran Daftar Ulang') }}
            </x-responsive-nav-link>
        @endif

        {{-- Kartu Pelajar --}}
        @if($isLulus)
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md">
                {{ __('Kartu Pelajar') }}
            </x-responsive-nav-link>
        @else
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md opacity-60" onclick="alert('Unduh Kartu Pelajar hanya terbuka jika Anda dinyatakan LULUS ujian seleksi.')">
                {{ __('Kartu Pelajar') }}
            </x-responsive-nav-link>
        @endif
    </div>

    <div class="p-6 border-t border-gray-100">
        <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs text-red-500 mt-2 hover:underline">Log Out</button>
        </form>
    </div>
</nav>