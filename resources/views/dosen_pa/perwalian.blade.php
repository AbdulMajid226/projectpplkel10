@extends('layouts.dosen_pa')

@section('title', 'Perwalian')

@section('content')

<div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Mahasiswa Perwalian</h1>
        <p class="mt-2 text-gray-600">Halaman ini menampilkan daftar mahasiswa perwalian</p>
    </div>
    <div class="mt-4 md:mt-0">
        <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
            Semester Ganjil 2024/2025
        </span>
    </div>
</div>
    <div class="container px-4 mx-auto">

<!-- Filter dan Pencarian -->
<div class="flex flex-wrap gap-4 mb-6">
    <select class="p-2 border rounded focus:outline-none focus:border-teal-500">
        <option>Pilih Prodi & Tahun</option>
        <option>Informatika 2022/2023</option>
        <option>Informatika 2023/2024</option>
    </select>
    <input type="text"
        placeholder="Cari mahasiswa..."
        class="p-2 border rounded focus:outline-none focus:border-teal-500">
    <button
        class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">
        Cari
    </button>
</div>

<!-- Informasi Mahasiswa -->
<div class="grid grid-cols-2 gap-6 ml-10 mb-8">
    <div>
        <div class="mb-4">
            <label class="block text-xl font-semibold text-gray-700 mb-1">Nama</label>
            <p class="text-base font-medium text-gray-900">Alice</p>
        </div>
        <div class="mb-1">
            <label class="block text-xl font-semibold text-gray-700 mb-1">NIM</label>
            <p class="text-base font-medium text-gray-900">24060122130001</p>
        </div>
    </div>
    <div>
        <div class="mb-4">
            <label class="block text-xl font-semibold text-gray-700 mb-1">Angkatan</label>
            <p class="text-base font-medium text-gray-900">2024</p>
        </div>
        <div class="mb-1">
            <label class="block text-xl font-semibold text-gray-700 mb-1">IPS (Semester Lalu)</label>
            <p class="text-base font-medium text-gray-900">3.85</p>
        </div>
    </div>
</div>

<!-- Semester Sections -->
<div class="space-y-2">
    @foreach($irs_data as $irs_per_semester)
    <div class="border rounded-lg overflow-hidden">
        <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none flex justify-between items-center"
                onclick="toggleSemester({{ $irs_per_semester['semester'] }})">
            <div class="flex items-center space-x-4">
                <span class="text-lg font-semibold text-blue-600">Semester-{{ $irs_per_semester['semester'] }}</span>
                <span class="text-gray-600">|</span>
                <span class="text-gray-800">Tahun Ajaran {{ $irs_per_semester['thn_ajaran'] }}</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">
                    @php
                        $totalSks = $irs_per_semester['matakuliah']->sum('sks');
                    @endphp
                    Jumlah SKS {{ $totalSks }}
                </span>
                <svg class="w-5 h-5 transform transition-transform" id="arrow-{{ $irs_per_semester['semester'] }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </button>

        <div class="hidden" id="semester-{{ $irs_per_semester['semester'] }}-content">
            <!-- Tabel Mata Kuliah -->
            <div class="bg-white">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Kode Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Nama Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Semester</th>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">SKS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($irs_per_semester['matakuliah'] as $index => $mk)
                        <tr>
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $mk['kode_mk'] }}</td>
                            <td class="px-6 py-4">{{ $mk['nama_mk'] }}</td>
                            <td class="px-6 py-4">{{ $mk['semester'] }}</td>
                            <td class="px-6 py-4">{{ $mk['kelas'] }}</td>
                            <td class="px-6 py-4">{{ $mk['status_pengambilan'] }}</td>
                            <td class="px-6 py-4">{{ $mk['sks'] }}</td>
                        </tr>
                        @endforeach

                        <!-- Baris Total SKS -->
                        <tr class="bg-gray-50 font-semibold">
                            <td colspan="6" class="px-6 py-4 text-right">Total SKS:</td>
                            <td class="px-6 py-4">
                                {{ $totalSks }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Print PDF -->
            <div class="bg-gray-50 px-6 py-3 border-t">
                <a href="{{ route('mahasiswa.print_irs', [
                       'semester' => $irs_per_semester['semester'],
                       'tahun' => str_replace('/', '_', $irs_per_semester['thn_ajaran'])
                   ]) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print PDF
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>


</div>
<script>
function toggleSemester(semester) {
    const content = document.getElementById(`semester-${semester}-content`);
    const arrow = document.getElementById(`arrow-${semester}`);

        content.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>
@endsection
