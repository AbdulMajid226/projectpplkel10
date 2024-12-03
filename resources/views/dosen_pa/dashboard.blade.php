@extends('layouts.dosen_pa')

@section('content')
    <!-- Informasi Tahun  -->
    <div class="flex flex-wrap gap-4 mb-6">
        <select class="w-48 p-2 border rounded focus:outline-none focus:border-teal-500"">
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
        <p>{{ $jumlahstatus['disetujui'] }}</p>
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
