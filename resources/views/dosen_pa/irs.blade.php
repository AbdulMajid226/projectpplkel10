@extends('layouts.dosen_pa')

@section('title', 'Pengesahan IRS')

@section('content')
    <div class="container px-4 mx-auto">
        <h1 class="mb-10 text-4xl font-bold text-gray-800">Pengesahan IRS</h1>
        <h1 class="mb-6 text-lg font-semibold">Ajuan IRS Mahasiswa <br> Semester Gasal Tahun Ajaran 2024/2025</h1>

        <!-- Filter dan Pencarian -->
        <div class="flex flex-wrap gap-4 mb-6">
            <select class="p-2 border rounded focus:outline-none focus:border-teal-500">
                <option>Semua Status</option>
                <option>Menunggu Persetujuan</option>
                <option>Sudah Disetujui</option>
                <option>Ditolak</option>
            </select>
            <input type="text"
                placeholder="Cari mahasiswa..."
                class="p-2 border rounded focus:outline-none focus:border-teal-500">
        </div>

        <!-- Tabel IRS -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr>
                        <th class="px-4 py-3 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-3 border border-gray-300 w-[20%]">Nama</th>
                        <th class="px-4 py-3 border border-gray-300 w-[10%]">NIM</th>
                        <th class="px-4 py-3 border border-gray-300 w-[5%]">Angkatan</th>
                        <th class="px-4 py-3 border border-gray-300 w-[5%]">SKS</th>
                        <th class="px-4 py-3 border border-gray-300 w-[20%]">Aksi</th>
                        <th class="px-4 py-3 border border-gray-300 w-[15%]">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3 border border-gray-300">1</td>
                        <td class="px-4 py-3 border border-gray-300">John Doe</td>
                        <td class="px-4 py-3 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-3 border border-gray-300">2022</td>
                        <td class="px-4 py-3 border border-gray-300">19</td>
                        <td class="px-4 py-3 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                        </td>
                        <td class="px-4 py-3 border border-gray-300">Sudah Disetujui</td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3 border border-gray-300">2</td>
                        <td class="px-4 py-3 border border-gray-300">Jane Smith</td>
                        <td class="px-4 py-3 border border-gray-300">24060122131124</td>
                        <td class="px-4 py-3 border border-gray-300">2022</td>
                        <td class="px-4 py-3 border border-gray-300">22</td>
                        <td class="px-4 py-3 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                        </td>
                        <td class="px-4 py-3 border border-gray-300">Sudah Disetujui</td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3 border border-gray-300">3</td>
                        <td class="px-4 py-3 border border-gray-300">Alice Brown</td>
                        <td class="px-4 py-3 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-3 border border-gray-300">2022</td>
                        <td class="px-4 py-3 border border-gray-300">24</td>
                        <td class="px-4 py-3 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">Setujui</button>
                            <button class="px-3 py-1 ml-2 text-white bg-red-500 rounded hover:bg-red-600">Tolak</button>
                            <button class="px-3 py-1 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600">Detail</button>
                        </td>
                        <td class="px-4 py-3 border border-gray-300">Menunggu Persetujuan</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            <nav class="flex items-center space-x-2">
                <button class="px-3 py-1 text-gray-600 bg-white border rounded hover:bg-gray-100">Previous</button>
                <button class="px-3 py-1 text-white bg-teal-600 border rounded">1</button>
                <button class="px-3 py-1 text-gray-600 bg-white border rounded hover:bg-gray-100">2</button>
                <button class="px-3 py-1 text-gray-600 bg-white border rounded hover:bg-gray-100">3</button>
                <button class="px-3 py-1 text-gray-600 bg-white border rounded hover:bg-gray-100">Next</button>
            </nav>
        </div>
    </div>
@endsection
