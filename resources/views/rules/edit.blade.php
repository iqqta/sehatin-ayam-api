<x-canvas-layout>
    <x-slot name="header">
        Ubah Data Aturan
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Ubah Aturan</h3>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Ups!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rules.update', $rule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="disease_id">
                        Penyakit
                    </label>
                    <select class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="disease_id" name="disease_id">
                        <option value="">Pilih Penyakit</option>
                        @foreach($diseases as $disease)
                            <option value="{{ $disease->id }}" {{ $disease->id == $rule->disease_id ? 'selected' : '' }}>{{ $disease->code }} - {{ $disease->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="symptom_id">
                        Gejala
                    </label>
                    <select class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="symptom_id" name="symptom_id">
                        <option value="">Pilih Gejala</option>
                        @foreach($symptoms as $symptom)
                            <option value="{{ $symptom->id }}" {{ $symptom->id == $rule->symptom_id ? 'selected' : '' }}>{{ $symptom->code }} - {{ $symptom->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mb">
                         MB (Nilai Keyakinan / Measure of Belief)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mb" type="number" step="0.01" name="mb" value="{{ $rule->mb }}">
                </div>
                 <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="md">
                        MD (Nilai Ketidakyakinan / Measure of Disbelief)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="md" type="number" step="0.01" name="md" value="{{ $rule->md }}">
                </div>
                
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('rules.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Batal
                    </a>
                    <button class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-canvas-layout>
