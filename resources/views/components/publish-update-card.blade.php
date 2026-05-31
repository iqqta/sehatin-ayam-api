@props(['latestVersion', 'hasPendingChanges'])

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8" 
     x-data="{ 
        showConfirmModal: false, 
        showErrorModal: false,
        errorMessage: '',
        isLoading: false,
        
async handleInitialCheck() {
    this.isLoading = true;
    try {
        let response = await fetch('{{ route('publish.check-integrity') }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        let result = await response.json();
        
        if (result.status === 'error') {
            // Mengambil result.details yang baru kita tambahkan di controller
            this.errorMessage = result.message + ' (' + result.details + ')';
            this.showErrorModal = true;
        } else {
            this.showConfirmModal = true;
        }
    } catch (error) {
        alert('Terjadi kesalahan sistem saat mengecek data.');
    } finally {
        this.isLoading = false;
    }
}
     }">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-medium text-gray-900">Status Pembaruan Basis Pengetahuan</h2>
            <div class="mt-1 text-sm">
                @if($hasPendingChanges)
                    <span class="text-amber-600 font-medium">Ada pembaruan data yang belum dirilis ke publik</span>
                @else
                    <span class="text-green-600 font-medium">Basis pengetahuan publik dalam kondisi terbaru</span>
                @endif
            </div>
            <div class="mt-2 flex items-center gap-4 text-xs text-slate-500">
                <span class="bg-gray-100 px-2 py-1 rounded border border-gray-200">
                    Versi Saat Ini: <span class="font-mono font-bold text-slate-800">{{ $latestVersion ? $latestVersion->version : '0' }}</span>
                </span>
                <span>
                    Terakhir Diperbarui: {{ $latestVersion ? $latestVersion->published_at->format('d M Y, H:i') : 'Belum Ada Data' }}
                </span>
            </div>
        </div>
        
        <div>
            <button 
                type="button"
                @click="handleInitialCheck()"
                :disabled="isLoading || !{{ $hasPendingChanges ? 'true' : 'false' }}"
                class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-md font-medium text-sm text-white hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                
                <svg x-show="isLoading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <span x-text="isLoading ? 'Mengecek Relasi...' : 'Perbarui'"></span>
            </button>
        </div>
    </div>

    <template x-teleport="body">
    <div x-show="showErrorModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showErrorModal = false"></div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-amber-100 sm:mx-0">
                            <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900">Pembaruan Tidak Dapat Dilakukan</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600" x-text="errorMessage"></p>
                                <p class="mt-2 text-xs text-gray-500 italic">*Silakan lengkapi aturan pada menu Manajemen Aturan sebelum melakukan publikasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click="showErrorModal = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-slate-800 text-base font-medium text-white hover:bg-slate-700 sm:w-auto sm:text-sm">
                        Tutup & Perbaiki
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

    <template x-teleport="body">
        <div x-show="showConfirmModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showConfirmModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 sm:mx-0">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Pembaruan</h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    Apakah Anda yakin ingin memperbarui versi ini? Pastikan semua data sudah benar dan siap untuk dirilis.
                                    Aksi ini akan meningkatkan nomor versi ke <span class="font-bold text-slate-800">Versi {{ $latestVersion ? $latestVersion->version + 1 : 1 }}</span>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form action="{{ route('publish.update') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-slate-800 text-sm font-medium text-white hover:bg-slate-700 sm:ml-3 sm:w-auto">
                                Perbarui
                            </button>
                        </form>
                        <button type="button" @click="showConfirmModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>