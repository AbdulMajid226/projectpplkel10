@extends('layouts.bagian_akademik')

@section('title', 'Ajukan Ruang Kuliah')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Ajukan Ruang Kuliah</h1>
            <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                Semester Ganjil 2024/2025
            </span>
        </div>

        <!-- Form Ajukan Ruang -->
        <div class="p-8 bg-white rounded-xl border border-gray-100 shadow-md">
            <form action="{{ route('ajukanruang.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Kode Ruang</label>
                        <input type="text" name="kode_ruang"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                            placeholder="Masukkan kode ruang" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Program Studi</label>
                        <select name="program_studi"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="IF">Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                            <option value="TI">Teknik Industri</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Kuota Fisik</label>
                        <input type="number" name="kuota"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                            placeholder="Masukkan jumlah kuota" required>
                    </div>
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="flex gap-2 items-center px-6 py-3 text-white bg-teal-600 rounded-lg transition duration-200 hover:bg-teal-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Ajukan Ruang
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Pengajuan -->
        <div class="mt-12">
            <h2 class="mb-6 text-2xl font-bold text-gray-800">Daftar Pengajuan Ruang</h2>
            <div class="overflow-hidden bg-white rounded-xl border border-gray-100 shadow-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Kode Ruang</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Program Studi</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Kuota</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ruangs as $ruang)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->kode_ruang }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->programStudi->nama_prodi }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->kuota }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($ruang->status == 'disetujui')
                                            <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                                {{ $ruang->status }}
                                            </span>
                                        @elseif($ruang->status == 'ditolak')
                                            <span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                                {{ $ruang->status }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                                {{ $ruang->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 space-x-3 text-sm font-medium whitespace-nowrap">
                                        <button onclick="editRoom('{{ $ruang->kode_ruang }}')" class="text-teal-600 transition duration-200 hover:text-teal-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        @if($ruang->status != 'disetujui')
                                        <form action="{{ route('ruang.destroy', $ruang->kode_ruang) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 transition duration-200 hover:text-red-900"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ruang ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="relative px-4 py-3 text-green-700 bg-green-100 rounded border border-green-400" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>
@endsection
