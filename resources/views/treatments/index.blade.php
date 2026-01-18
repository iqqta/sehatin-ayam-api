<x-canvas-layout>
    <x-slot name="header">
        Penanganan
    </x-slot>

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between mb-6">
                <h3 class="text-lg font-bold">Daftar Penanganan</h3>
                <a href="{{ route('treatments.create') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                    Tambah Penanganan
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal border border-gray-200 table-fixed">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">
                            Penyakit
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/2">
                            Penanganan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($treatments as $diseaseId => $diseaseTreatments)
                        @foreach ($diseaseTreatments as $index => $treatment)
                            <tr class="hover:bg-gray-50 transition-colors">
                                {{-- Show Disease Column only for the first row of the group --}}
                                @if ($index === 0)
                                    <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-100 border-b border-gray-200 align-top bg-white" rowspan="{{ $diseaseTreatments->count() }}">
                                        <div class="font-medium text-gray-900">{{ $treatment->disease->name }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $treatment->disease->code }}</div>
                                    </td>
                                @endif

                                <td class="px-6 py-4 text-sm text-gray-600 break-all {{ $loop->last ? 'border-b border-gray-200' : 'border-b border-gray-100' }}">
                                    {{ $treatment->treat }}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium {{ $loop->last ? 'border-b border-gray-200' : 'border-b border-gray-100' }}">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('treatments.edit', $treatment) }}" class="text-blue-600 hover:text-blue-900 inline-flex items-center" title="Ubah">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" class="inline-flex" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 inline-flex items-center" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center italic border-b border-gray-200">
                                Belum ada data penanganan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
            </div>
        </div>
    </div>
</x-canvas-layout>
