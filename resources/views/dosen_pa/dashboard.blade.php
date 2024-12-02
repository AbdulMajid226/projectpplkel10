@extends('layouts.dosen_pa')

@section('content')
    <!-- Informasi Tahun  -->
    <div class="flex flex-wrap gap-4 mb-6">
        <select class="p-2 border rounded">
            <option>Pilih Tahun Ajaran</option>
            <option>2023/2024 Ganjil</option>
            <option>2023/2024 Genap</option>
            <option>2024/2025 Ganjil</option>
            <option>2024/2025 Genap</option>
        </select>
    </div>

    <h1 class="text-lg font-bold">Informasi Pengisian IRS</h1>
    <h1 class="text-lg font-semibold">Semester Ganjil 2024/2025</h1>
   <!-- Status boxes dengan onclick event -->
<div class="grid grid-cols-1 gap-4 p-3 bg-teal-600 rounded-lg shadow md:grid-cols-3">
    <div onclick="toggleTable('belum')" class="p-4 text-center bg-white rounded-lg shadow cursor-pointer hover:bg-gray-50">
        <p class="text-2xl font-bold">Belum Mengisi</p>
        <p>{{ $jumlahstatus['belumMengisi'] }}</p>
    </div>
    <div onclick="toggleTable('menunggu')" class="p-4 text-center bg-white rounded-lg shadow cursor-pointer hover:bg-gray-50">
        <p class="text-2xl font-bold">Menunggu Persetujuan</p>
        <p>{{ $jumlahstatus['menungguPersetujuan'] }}</p>
    </div>
    <div onclick="toggleTable('disetujui')" class="p-4 text-center bg-white rounded-lg shadow cursor-pointer hover:bg-gray-50">
        <p class="text-2xl font-bold">Sudah Disetujui</p>
        <p>{{ $jumlahstatus['sudahDisetujui'] }}</p>
    </div>
</div>

<!-- Tabel untuk masing-masing status (hidden by default) -->
<div id="table-belum" class="hidden mt-4">
    <div class="overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300">
            <thead>
                <tr class="text-left bg-teal-500">
                    <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                    <th class="px-4 py-2 border border-gray-300 w-[20%]">Nama</th>
                    <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                    <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                    <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data untuk status Belum Mengisi -->
            </tbody>
        </table>
    </div>
</div>

<div id="table-menunggu" class="hidden mt-4">
    <div class="overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300">
            <thead>
                <tr class="text-left bg-teal-500">
                    <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                    <th class="px-4 py-2 border border-gray-300 w-[20%]">Nama</th>
                    <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                    <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                    <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                    <th class="px-4 py-2 border border-gray-300 w-[20%]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data untuk status Menunggu Persetujuan -->
            </tbody>
        </table>
    </div>
</div>

<div id="table-disetujui" class="hidden mt-4">
    <div class="overflow-x-auto">
        <table class="min-w-full border border-collapse border-gray-300">
            <thead>
                <tr class="text-left bg-teal-500">
                    <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                    <th class="px-4 py-2 border border-gray-300 w-[20%]">Nama</th>
                    <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                    <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                    <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                    <th class="px-4 py-2 border border-gray-300 w-[20%]">Detail</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data untuk status Sudah Disetujui -->
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
