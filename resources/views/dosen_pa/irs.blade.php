@extends('layouts.dosen_pa')

@section('title', 'Pengesahan IRS')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800 mb-10">Pengesahan IRS</h1>
        <h1 class="font-semibold text-center text-[20px]">Ajuan IRS Mahasiswa <br> Semester Gasal Tahun Ajaran
            2024/2025</h1>
        <!-- Filter dan Pencarian -->
        <div class="flex flex-wrap gap-4 mb-6">
            <select class="p-2 border rounded">
                <option>Semua Status</option>
                <option>Menunggu Persetujuan</option>
                <option>Disetujui</option>
                <option>Ditolak</option>
            </select>
            <input type="text" placeholder="Cari mahasiswa..." class="p-2 border rounded">
        </div>

        <!-- Tabel IRS -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead>
                    <tr class="text-left bg-teal-500">
                        <th class="px-4 py-2 border border-gray-300">No</th>
                        <th class="px-4 py-2 border border-gray-300">Nama</th>
                        <th class="px-4 py-2 border border-gray-300">NIM</th>
                        <th class="px-4 py-2 border border-gray-300">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300">SKS</th>
                        <th class="px-4 py-2 border border-gray-300">Aksi</th>
                        <th class="px-4 py-2 border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">1</td>
                        <td class="px-4 py-2 border border-gray-300">John Doe</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">19</td>
                        <td class="px-4 py-2 border border-gray-300"><button class="px-4 py-2 ml-2 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Telah Disetujui </td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">2</td>
                        <td class="px-4 py-2 border border-gray-300">Jane Smith</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131124</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">22</td>
                        <td class="px-4 py-2 border border-gray-300"><button class="px-4 py-2 ml-2 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Telah Disetujui </td>
                    </tr>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">3</td>
                        <td class="px-4 py-2 border border-gray-300">Alice Brown</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">24</td>
                        <td class="px-4 py-2 border border-gray-300"> <button
                                class="px-4 py-2 text-white bg-gray-900 rounded">Setujui</button> <button
                                class="px-4 py-2 ml-8 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Belum Disetujui </td>
                    </tr>
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
        </div>
    </div>
@endsection
