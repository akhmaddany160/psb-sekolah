<x-app-layout>
    <div class="min-h-[60vh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <div class="mb-4">
             <h2 class="text-sm text-gray-600 italic">Ingin Bersekolah di Jenjang Apa, Ayah/Bunda?</h2>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('jenjang.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <h1 class="text-xl font-semibold text-gray-900">Pilih Jenjang...</h1>
                </div>

                <div>
                    <label class="block font-medium text-sm text-gray-700" for="jenjang">
                        Pilih Satu Jenjang Pendidikan
                    </label>
                    
                    <select id="jenjang" name="jenjang" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="SD" {{ auth()->user()->jenjang == 'SD' ? 'selected' : '' }}>PMC Kids (TK)</option>
                        <option value="SMP" {{ auth()->user()->jenjang == 'SMP' ? 'selected' : '' }}>PMC Home School (SD)</option>
                        <option value="SMA" {{ auth()->user()->jenjang == 'SMA' ? 'selected' : '' }}>Al-Bayan Huffadz School (SMP/SMA)</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-8">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Pilih') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>