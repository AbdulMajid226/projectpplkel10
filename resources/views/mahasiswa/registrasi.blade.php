@extends('layouts.mahasiswa')

@section('title', 'Registrasi Mahasiswa')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 text-center mb-6">Registrasi Semester</h1>
            <p class="text-gray-600 text-center mb-10">
                Silakan pilih status registrasi Anda untuk semester ini
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Kartu Aktif -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-8 flex flex-col items-center">
                    <div class="bg-green-100 p-3 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Aktif</h2>
                    <p class="text-gray-600 text-center mb-6">
                        Anda akan mengikuti kegiatan perkuliahan pada semester ini serta mengisi Isian Rencana
                        Studi (IRS).
                    </p>
                    <form action="{{ route('mahasiswa.aktif') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                @if(auth()->user()->mahasiswa->status !== 'BelumRegistrasi') disabled @endif
                                class="bg-green-600 text-white px-6 py-2.5 rounded-lg transition-colors duration-300 font-medium
                                {{ auth()->user()->mahasiswa->status !== 'BelumRegistrasi'
                                    ? 'opacity-50 cursor-not-allowed'
                                    : 'hover:bg-green-700' }}">
                            @if(auth()->user()->mahasiswa->status === 'Aktif')
                                Sudah Aktif
                            @elseif(auth()->user()->mahasiswa->status === 'Cuti')
                                Sedang Cuti
                            @else
                                Pilih Aktif
                            @endif
                        </button>
                    </form>
                </div>

                <!-- Kartu Cuti -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-8 flex flex-col items-center">
                    <div class="bg-red-100 p-3 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Cuti</h2>
                    <p class="text-gray-600 text-center mb-6">
                        Menghentikan kuliah sementara untuk semester ini tanpa kehilangan status sebagai
                        mahasiswa Undip.
                    </p>
                    <form action="{{ route('mahasiswa.ajukan-cuti') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                @if(auth()->user()->mahasiswa->status !== 'BelumRegistrasi') disabled @endif
                                class="bg-red-600 text-white px-6 py-2.5 rounded-lg transition-colors duration-300 font-medium
                                {{ auth()->user()->mahasiswa->status !== 'BelumRegistrasi'
                                    ? 'opacity-50 cursor-not-allowed'
                                    : 'hover:bg-red-700' }}">
                            @if(auth()->user()->mahasiswa->status === 'Aktif')
                                Sudah Aktif
                            @elseif(auth()->user()->mahasiswa->status === 'Cuti')
                                Sedang Cuti
                            @else
                                Pilih Cuti
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Modal backdrop -->
            <div class="fixed inset-0 bg-black opacity-50" id="modalBackdrop"></div>

            <!-- Modal content -->
            <div class="relative bg-white rounded-lg w-full max-w-md p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi</h3>
                </div>
                <div class="mb-6">
                    <p id="confirmationText" class="text-gray-600"></p>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" id="cancelButton"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="button" id="confirmButton"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('confirmationModal');
            const modalBackdrop = document.getElementById('modalBackdrop');
            const cancelButton = document.getElementById('cancelButton');
            const confirmButton = document.getElementById('confirmButton');
            let formToSubmit;

            // Fungsi untuk menampilkan modal
            function showModal() {
                modal.classList.remove('hidden');
            }

            // Fungsi untuk menyembunyikan modal
            function hideModal() {
                modal.classList.add('hidden');
            }

            // Event listener untuk tombol submit
            document.querySelectorAll('button[type="submit"]').forEach(button => {
                button.addEventListener('click', function (event) {
                    if (!button.disabled) {
                        event.preventDefault();
                        formToSubmit = this.closest('form');

                        // Tentukan teks konfirmasi berdasarkan tombol yang ditekan
                        const confirmationText = this.textContent.trim() === 'Pilih Aktif' ?
                            'Apakah Anda yakin ingin memilih status Aktif untuk semester ini?' :
                            'Apakah Anda yakin ingin memilih status Cuti untuk semester ini?';

                        document.getElementById('confirmationText').textContent = confirmationText;
                        showModal();
                    }
                });
            });

            // Event listener untuk tombol batal
            cancelButton.addEventListener('click', hideModal);
            modalBackdrop.addEventListener('click', hideModal);

            // Event listener untuk tombol konfirmasi
            confirmButton.addEventListener('click', function () {
                formToSubmit.submit();
                hideModal();
            });
        });
    </script>
@endsection
