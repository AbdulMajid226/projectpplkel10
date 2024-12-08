@extends('layouts.dekan')

@section('title', 'Pengesahan Ruang Kuliah')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Pengesahan Ruang Kuliah</h1>
        <h1 class="mb-6 text-lg font-semibold">Ajuan Ruang Kuliah <br> Semester Gasal Tahun Ajaran 2024/2025</h1>

        <!-- Filter dan Pencarian -->
        <div class="flex flex-wrap gap-4 mb-6">
            <select class="p-2 border rounded focus:outline-none focus:border-teal-500">
                <option>Semua Status</option>
                <option>Menunggu Persetujuan</option>
                <option>Sudah Disetujui</option>
                <option>Ditolak</option>
            </select>
            <select class="p-2 border rounded">
                <option>Semua Program Studi</option>
                <option>Informatika</option>
                <option>Sistem Informasi</option>
            </select>
            <input type="text"
                placeholder="Cari ruang..."
                class="p-2 border rounded focus:outline-none focus:border-teal-500">
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr>
                        <th class="px-4 py-3 border border-gray-300">Kode Ruang</th>
                        <th class="px-4 py-3 border border-gray-300">Program Studi</th>
                        <th class="px-4 py-3 border border-gray-300">Kuota</th>
                        <th class="px-4 py-3 border border-gray-300">Fasilitas</th>
                        <th class="px-4 py-3 border border-gray-300">Status</th>
                        <th class="px-4 py-3 border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">E101</td>
                        <td class="px-6 py-4">Informatika</td>
                        <td class="px-6 py-4">40</td>
                        <td class="px-6 py-4">AC, Proyektor</td>
                        <td class="px-6 py-4 border border-gray-300">Sudah Disetujui</td>
                        <td class="px-6 py-4 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                        </td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">E101</td>
                        <td class="px-6 py-4">Informatika</td>
                        <td class="px-6 py-4">40</td>
                        <td class="px-6 py-4">AC, Proyektor</td>
                        <td class="px-6 py-4 border border-gray-300">Sudah Disetujui</td>
                        <td class="px-6 py-4 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                        </td>
                    </tr>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">E101</td>
                        <td class="px-6 py-4">Informatika</td>
                        <td class="px-6 py-4">40</td>
                        <td class="px-6 py-4">AC, Proyektor</td>
                        <td class="px-6 py-4 border border-gray-300">Menunggu Persetujuan</td>
                        <td class="px-6 py-4 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">Setujui</button>
                            <button class="px-3 py-1 ml-2 text-white bg-red-500 rounded hover:bg-red-600">Tolak</button>
                            <button class="px-3 py-1 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600">Detail</button>
                        </td>
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

        {{-- <!-- Tabel Ruang -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Ruang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program Studi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fasilitas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4">E101</td>
                        <td class="px-6 py-4">Informatika</td>
                        <td class="px-6 py-4">40</td>
                        <td class="px-6 py-4">AC, Proyektor</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                Menunggu Persetujuan
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-blue-600 hover:text-blue-900">Detail</button>
                            <button class="ml-4 text-green-600 hover:text-green-900">Setujui</button>
                            <button class="ml-4 text-red-600 hover:text-red-900">Tolak</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            <nav class="flex items-center space-x-2">
                <button class="px-3 py-1 rounded border">Previous</button>
                <button class="px-3 py-1 rounded border bg-blue-600 text-white">1</button>
                <button class="px-3 py-1 rounded border">2</button>
                <button class="px-3 py-1 rounded border">3</button>
                <button class="px-3 py-1 rounded border">Next</button>
            </nav>
        </div> --}}
    </div>
@endsection
