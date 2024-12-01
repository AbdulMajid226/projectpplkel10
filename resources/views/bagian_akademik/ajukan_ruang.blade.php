@extends('layouts.bagian_akademik')

@section('title', 'Ajukan Ruang Kuliah')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800 mb-10">Ajukan Ruang Kuliah</h1>

        <!-- Form Ajukan Ruang -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="#" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Ruang</label>
                        <input type="text" name="kode_ruang" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <select name="program_studi" class="w-full p-2 border rounded" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="IF">Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                            <option value="TI">Teknik Industri</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kuota</label>
                        <input type="number" name="kuota" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                        <div class="space-y-2">
                            <div>
                                <input type="checkbox" id="ac" name="fasilitas[]" value="ac">
                                <label for="ac">AC</label>
                            </div>
                            <div>
                                <input type="checkbox" id="proyektor" name="fasilitas[]" value="proyektor">
                                <label for="proyektor">Proyektor</label>
                            </div>
                            <div>
                                <input type="checkbox" id="komputer" name="fasilitas[]" value="komputer">
                                <label for="komputer">Komputer</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">
                        Ajukan Ruang
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Pengajuan -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pengajuan Ruang</h2>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Ruang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program Studi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4">E101</td>
                            <td class="px-6 py-4">Informatika</td>
                            <td class="px-6 py-4">40</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                    Menunggu Persetujuan
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                <button class="ml-4 text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
