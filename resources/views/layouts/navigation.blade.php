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

        @php
            $menus = ['Pemberkasan', 'Pembayaran Formulir', 'Test Seleksi', 'Hasil Test Seleksi', 'Pembayaran Daftar Ulang', 'Kartu Pelajar'];
        @endphp

        @foreach($menus as $menu)
            <x-responsive-nav-link href="#" class="block w-full py-3 text-center border rounded-md opacity-60">
                {{ $menu }}
            </x-responsive-nav-link>
        @endforeach
    </div>

    <div class="p-6 border-t border-gray-100">
        <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs text-red-500 mt-2 hover:underline">Log Out</button>
        </form>
    </div>
</nav>