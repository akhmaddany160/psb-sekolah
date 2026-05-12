<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lengkapi Biodata Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('student.profile.update') }}">
                    @csrf

                    <div>
                        <x-input-label for="nisn" :value="__('NISN')" />
                        <x-text-input id="nisn" name="nisn" type="text" class="mt-1 block w-full" :value="old('nisn', $detail->nisn ?? '')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nisn')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="asal_sekolah" :value="__('Asal Sekolah')" />
                        <x-text-input id="asal_sekolah" name="asal_sekolah" type="text" class="mt-1 block w-full" :value="old('asal_sekolah', $detail->asal_sekolah ?? '')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('asal_sekolah')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                        <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat', $detail->alamat ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                    </div>

                    <div class="flex items-center mt-6">
                        <x-primary-button>
                            {{ __('Simpan Biodata') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>