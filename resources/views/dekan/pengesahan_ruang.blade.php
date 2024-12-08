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
                    @foreach($ruangs as $ruang)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $ruang->kode_ruang }}</td>
                        <td class="px-6 py-4">{{ $ruang->programStudi->nama_prodi }}</td>
                        <td class="px-6 py-4">{{ $ruang->kuota }}</td>
                        <td class="px-6 py-4">{{ $ruang->fasilitas }}</td>
                        <td class="px-6 py-4 border border-gray-300">
                            <span class="{{ app('App\Http\Controllers\RuangController')->getStatusColorClass($ruang->status) }} px-2 py-1 rounded">
                                {{ $ruang->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border border-gray-300">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                            @if($ruang->status == 'BelumDisetujui')
                                <form action="{{ route('ruang.approve', $ruang->kode_ruang) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 ml-2 text-white bg-green-500 rounded hover:bg-green-600">Setujui</button>
                                </form>
                                <form action="{{ route('ruang.reject', $ruang->kode_ruang) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 ml-2 text-white bg-red-500 rounded hover:bg-red-600">Tolak</button>
                                </form>
                            @elseif($ruang->status == 'disetujui')
                                <form action="{{ route('ruang.cancel', $ruang->kode_ruang) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 ml-2 text-white bg-red-500 rounded hover:bg-yellow-600">Batalkan Persetujuan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
