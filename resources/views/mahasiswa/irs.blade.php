@extends('layouts.mahasiswa')

@section('title', 'Isian Rencana Studi (IRS)')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-10">Isian Rencana Studi (IRS)</h1>
        
        <!-- Informasi Mahasiswa -->
        <div class="grid grid-cols-2 gap-6 ml-10 mb-8">
            <div>
                <div class="mb-4">
                    <label class="block text-xl font-semibold text-gray-700 mb-1">Nama</label>
                    <p class="text-base font-medium text-gray-900">Alice Bob</p>
                </div>
                <div class="mb-1">
                    <label class="block text-xl font-semibold text-gray-700 mb-1">NIM</label>
                    <p class="text-base font-medium text-gray-900">24060122130099</p>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <label class="block text-xl font-semibold text-gray-700 mb-1">Angkatan</label>
                    <p class="text-base font-medium text-gray-900">2022</p>
                </div>
                <div class="mb-1">
                    <label class="block text-xl font-semibold text-gray-700 mb-1">IPS (Semester Lalu)</label>
                    <p class="text-base font-medium text-gray-900">3.85</p>
                </div>
            </div>
        </div>

        <!-- Semester Sections -->
        <div class="space-y-2">
            @php
            $semesters = [
                [
                    'semester' => 1, 
                    'tahun' => '2022/2023', 
                    'periode' => 'Ganjil', 
                    'sks' => 10,
                    'matakuliah' => [
                        ['kode_mk' => 'PAIK6501', 'nama_mk' => 'Pengembangan Berbasis Platform', 'semester' => '1', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '4'],
                        ['kode_mk' => 'PAIK6502', 'nama_mk' => 'Komputasi Tersebar dan Paralel', 'semester' => '1', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6503', 'nama_mk' => 'Sistem Informasi', 'semester' => '1', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3']
                    ]
                ],
                [
                    'semester' => 2, 
                    'tahun' => '2022/2023', 
                    'periode' => 'Genap', 
                    'sks' => 9,
                    'matakuliah' => [
                        ['kode_mk' => 'PAIK6504', 'nama_mk' => 'Proyek Perangkat Lunak', 'semester' => '2', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6505', 'nama_mk' => 'Pembelajaran Mesin', 'semester' => '2', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6506', 'nama_mk' => 'Keamanan Jaminan dan Informasi', 'semester' => '2', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3']
                    ]
                ],
                [
                    'semester' => 3, 
                    'tahun' => '2023/2024', 
                    'periode' => 'Ganjil', 
                    'sks' => 10,
                    'matakuliah' => [
                        ['kode_mk' => 'PAIK6501', 'nama_mk' => 'Pengembangan Berbasis Platform', 'semester' => '3', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '4'],
                        ['kode_mk' => 'PAIK6502', 'nama_mk' => 'Komputasi Tersebar dan Paralel', 'semester' => '3', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6503', 'nama_mk' => 'Sistem Informasi', 'semester' => '3', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3']
                    ]
                ],
                [
                    'semester' => 4, 
                    'tahun' => '2023/2024', 
                    'periode' => 'Genap', 
                    'sks' => 9,
                    'matakuliah' => [
                        ['kode_mk' => 'PAIK6504', 'nama_mk' => 'Proyek Perangkat Lunak', 'semester' => '4', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6505', 'nama_mk' => 'Pembelajaran Mesin', 'semester' => '4', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6506', 'nama_mk' => 'Keamanan Jaminan dan Informasi', 'semester' => '4', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3']
                    ]
                ],
                [
                    'semester' => 5, 
                    'tahun' => '2024/2025', 
                    'periode' => 'Ganjil', 
                    'sks' => 19,
                    'matakuliah' => [
                        ['kode_mk' => 'PAIK6501', 'nama_mk' => 'Pengembangan Berbasis Platform', 'semester' => '5', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '4'],
                        ['kode_mk' => 'PAIK6502', 'nama_mk' => 'Komputasi Tersebar dan Paralel', 'semester' => '5', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6503', 'nama_mk' => 'Sistem Informasi', 'semester' => '5', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6504', 'nama_mk' => 'Proyek Perangkat Lunak', 'semester' => '5', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6505', 'nama_mk' => 'Pembelajaran Mesin', 'semester' => '5', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3'],
                        ['kode_mk' => 'PAIK6506', 'nama_mk' => 'Keamanan Jaminan dan Informasi', 'semester' => '5', 'kelas' => 'D', 'status' => 'Baru', 'sks' => '3']
                    ]
                ]
            ];
            @endphp

            @foreach($semesters as $sem)
            <div class="border rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none flex justify-between items-center" 
                        onclick="toggleSemester({{ $sem['semester'] }})">
                    <div class="flex items-center space-x-4">
                        <span class="text-lg font-semibold text-blue-600">Semester-{{ $sem['semester'] }}</span>
                        <span class="text-gray-600">|</span>
                        <span class="text-gray-800">Tahun Ajaran {{ $sem['tahun'] }} {{ $sem['periode'] }}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Jumlah SKS {{ $sem['sks'] }}</span>
                        <svg class="w-5 h-5 transform transition-transform" id="arrow-{{ $sem['semester'] }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>

                <div class="hidden" id="semester-{{ $sem['semester'] }}-content">
                    @include('mahasiswa.irs_table', ['matakuliah' => $sem['matakuliah']])
                    
                    <!-- Tombol Print PDF -->
                    <div class="bg-gray-50 px-6 py-3 border-t">
                        <button type="button" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print PDF
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
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
