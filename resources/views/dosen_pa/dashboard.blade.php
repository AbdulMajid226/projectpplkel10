@extends('layouts.dosen_pa')

@section('content')
    <!-- Header Dashboard -->
    <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pembimbing Akademik</h1>
            <p class="mt-2 text-gray-600">Selamat datang di panel kontrol Pembimbing Akademik</p>
        </div>
        <div class="mt-4 md:mt-0">
            <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                Semester Ganjil 2024/2025
            </span>
        </div>
    </div>

    <!-- Informasi Tahun  -->
    <div class="flex flex-wrap gap-4 mb-6">
        <select class="w-48 p-2 border rounded focus:outline-none focus:border-teal-500">
            <option>Pilih Tahun Ajaran</option>
            <option>2023/2024 Ganjil</option>
            <option>2023/2024 Genap</option>
            <option>2024/2025 Ganjil</option>
            <option>2024/2025 Genap</option>
        </select>
    </div>

    <!-- Card Rekapan Status IRS -->
    <div class="p-6 mb-8 shadow-lg bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl">
        <h2 class="mb-6 text-xl font-semibold text-white">Informasi Pengisian IRS</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Card Belum Mengisi -->
            <div onclick="toggleTable('belum')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Belum Mengisi</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $jumlahstatus['belumMengisi'] }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div onclick="toggleTable('menunggu')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $jumlahstatus['menungguPersetujuan'] }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Sudah Disetujui -->
            <div onclick="toggleTable('disetujui')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Sudah Disetujui</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $jumlahstatus['disetujui'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Belum Mengisi -->
    <div id="table-belum" class="hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr class="text-left">
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[30%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Status Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($irsData['belumMengisi'] as $index => $irs)
                    <tr class="min-w-full text-sm text-left text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->angkatan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Menunggu Persetujuan -->
    <div id="table-menunggu" class="hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr class="text-left">
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[30%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($irsData['menungguPersetujuan'] as $index => $irs)
                    <tr class="min-w-full text-sm text-left text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->angkatan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->total_sks ?? '-' }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">Setujui</button>
                            <button class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">Tolak</button>
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Sudah Disetujui -->
    <div id="table-disetujui" class="hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr class="text-left">
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($irsData['disetujui'] as $index => $irs)
                    <tr class="min-w-full text-sm text-left text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->angkatan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->total_sks ?? '-' }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script untuk toggle tabel -->
    <script>
        function toggleTable(status) {
            // Sembunyikan semua tabel terlebih dahulu
            document.getElementById('table-belum').classList.add('hidden');
            document.getElementById('table-menunggu').classList.add('hidden');
            document.getElementById('table-disetujui').classList.add('hidden');

            // Tampilkan tabel yang dipilih
            document.getElementById('table-' + status).classList.remove('hidden');
        }
    </script>
@endsection
