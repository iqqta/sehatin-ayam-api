<x-canvas-layout>
    <x-slot name="header">
        Ubah Data Penanganan
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('treatments.update', $treatment) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Disease Selection -->
                    <div>
                        <x-input-label for="disease_id" value="Penyakit" />
                        <select id="disease_id" name="disease_id" class="mt-1 block w-full border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Penyakit --</option>
                            @foreach($diseases as $disease)
                                <option value="{{ $disease->id }}" {{ old('disease_id', $treatment->disease_id) == $disease->id ? 'selected' : '' }}>
                                    {{ $disease->code }} - {{ $disease->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('disease_id')" class="mt-2" />
                    </div>

                    <!-- Treatment Text -->
                    <div>
                        <x-input-label for="treat" value="Penanganan" />
                        <textarea id="treat" name="treat" rows="5" class="mt-1 block w-full border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" required>{{ old('treat', $treatment->treat) }}</textarea>
                        <x-input-error :messages="$errors->get('treat')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('treatments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Batal
                        </a>
                        <x-primary-button>
                            Simpan Perubahan
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-canvas-layout>
