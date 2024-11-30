<x-mahasiswa-layout>
    <x-slot:title>Registrasi Mahasiswa</x-slot:title>

    <x-slot:content>
        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6 sm:ml-2 md:ml-60 lg:ml-60 mt-10">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-800 text-center mb-10">Registrasi</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Kartu Aktif -->
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Aktif</h2>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                        <p class="text-gray-600 text-center mb-4">
                            Anda akan mengikuti kegiatan perkuliahan pada semester ini serta mengisi isian Rencana
                            Studi
                            (IRS).
                        </p>
                        <button class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Pilih</button>
                    </div>

                    <!-- Kartu Cuti -->
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">

                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Cuti</h2>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <p class="text-gray-600 text-center mb-4">
                            Menghentikan kuliah sementara untuk semester ini tanpa kehilangan status sebagai
                            mahasiswa
                            Undip.
                        </p>
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Pilih</button>
                    </div>
                </div>
            </div>
        </main>
    </x-slot:content>
</x-mahasiswa-layout>