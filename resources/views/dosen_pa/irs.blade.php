@extends('layouts.dosen_pa')

@section('title', 'Pengesahan IRS')

@section('content')
    <div class="container px-4 mx-auto">
        <h1 class="mb-10 text-4xl font-bold text-gray-800">Pengesahan IRS</h1>
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
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Aksi</th>
                        <th class="px-4 py-2 border border-gray-300 w-[15%]">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">1</td>
                        <td class="px-4 py-2 border border-gray-300">John Doe</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">19</td>
                        <td class="px-4 py-2 border border-gray-300"><button class="px-4 py-2 ml-1 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Telah Disetujui </td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">2</td>
                        <td class="px-4 py-2 border border-gray-300">Jane Smith</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131124</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">22</td>
                        <td class="px-4 py-2 border border-gray-300"><button class="px-4 py-2 ml-1 text-black bg-gray-300 rounded">Detail</button></td>
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
                <button class="px-3 py-1 border rounded">Previous</button>
                <button class="px-3 py-1 text-white bg-blue-600 border rounded">1</button>
                <button class="px-3 py-1 border rounded">2</button>
                <button class="px-3 py-1 border rounded">3</button>
                <button class="px-3 py-1 border rounded">Next</button>
            </nav>
        </div>
    </div>
@endsection
