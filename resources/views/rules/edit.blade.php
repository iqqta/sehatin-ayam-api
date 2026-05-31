<x-app-layout>
    <x-slot name="header">
        Ubah Data Aturan
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Ubah Aturan</h3>
            <form action="{{ route('rules.update', [$rule->disease_code, $rule->symptom_code]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="disease_code">
                        Penyakit
                    </label>
                    <select class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="disease_code" name="disease_code">
                        <option value="">Pilih Penyakit</option>
                        @foreach($diseases as $disease)
                            <option value="{{ $disease->disease_code }}" {{ $disease->disease_code == $rule->disease_code ? 'selected' : '' }}>{{ $disease->disease_code }} - {{ $disease->name }}</option>
                        @endforeach
                    </select>
                    @error('disease_code')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="symptom_code">
                        Gejala
                    </label>
                    <select class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="symptom_code" name="symptom_code">
                        <option value="">Pilih Gejala</option>
                        @foreach($symptoms as $symptom)
                            <option value="{{ $symptom->symptom_code }}" {{ $symptom->symptom_code == $rule->symptom_code ? 'selected' : '' }}>{{ $symptom->symptom_code }} - {{ $symptom->name }}</option>
                        @endforeach
                    </select>
                    @error('symptom_code')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mb">
                         MB (Nilai Keyakinan / Measure of Belief)
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mb" name="mb">
                        <option value="">Pilih Nilai</option>
                        @for ($i = 0; $i <= 10; $i++)
                            @php $val = number_format($i/10, 1); @endphp
                            <option value="{{ $val }}" {{ number_format((float)$rule->mb, 1) === $val ? 'selected' : '' }}>{{ $val }}</option>
                        @endfor
                    </select>
                    @error('mb')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                 <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="md">
                        MD (Nilai Ketidakyakinan / Measure of Disbelief)
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="md" name="md">
                        <option value="">Pilih Nilai</option>
                        @for ($i = 0; $i <= 10; $i++)
                            @php $val = number_format($i/10, 1); @endphp
                            <option value="{{ $val }}" {{ number_format((float)$rule->md, 1) === $val ? 'selected' : '' }}>{{ $val }}</option>
                        @endfor
                    </select>
                    @error('md')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
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
</x-app-layout>
