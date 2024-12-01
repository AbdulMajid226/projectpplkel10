@extends('layouts.kaprodi')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Buat Jadwal Kuliah</h1>

        <!-- Form Buat Jadwal -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Mata Kuliah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                        <select name="mata_kuliah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            @foreach($mataKuliahs as $mk)
                                <option value="{{ $mk->kode_mk }}">{{ $mk->nama }} ({{ $mk->kode_mk }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dosen Pengampu (Multiple) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dosen Pengampu</label>
                        <select name="dosen[]" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <!-- Tahun Ajaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                        <select name="thn_ajaran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            <option value="Ganjil 2024/2025">Ganjil 2024/2025</option>
                            <option value="Genap 2024/2025">Genap 2024/2025</option>
                        </select>
                    </div>

                    <!-- Hari -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Hari</label>
                        <select name="hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>

                    <!-- Waktu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Waktu</label>
                        <select name="waktu_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            @foreach($waktus as $waktu)
                                <option value="{{ $waktu->id }}">{{ $waktu->jam_mulai }} - {{ $waktu->jam_selesai }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ruang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ruang</label>
                        <select name="ruang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->kode_ruang }}">{{ $ruang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700">
                        Buat Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Jadwal -->
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Daftar Jadwal</h2>
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwals as $jadwal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->mataKuliah->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @foreach($jadwal->mataKuliah->pengampuanDosen as $dosen)
                                        {{ $dosen->nama }}<br>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->kelas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->hari }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->waktu->jam_mulai }} - {{ $jadwal->waktu->jam_selesai }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->ruang->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editJadwal({{ $jadwal->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
