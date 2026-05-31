<x-app-layout>
    <x-slot name="header">
        Ubah Data Gejala
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Ubah Gejala: {{ $symptom->symptom_code }}</h3>
            <form action="{{ route('symptoms.update', $symptom->symptom_code) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="symptom_code">
                        Kode
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="symptom_code" type="text" name="symptom_code" value="{{ $symptom->symptom_code }}" placeholder="Contoh: G01">
                    @error('symptom_code')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama Gejala
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ $symptom->name }}" placeholder="Nama Gejala">
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('symptoms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Batal
                    </a>
                    <button class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
