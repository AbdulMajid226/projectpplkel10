@extends('layouts.mahasiswa')

@section('title', 'Buat IRS')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Buat IRS</h1>
            <h1 class="text-2xl font-bold text-gray-800">IRS (3sks)</h1>
        </div>

        <!-- Informasi Akademik -->
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-600">IP Semester Lalu: 4.00</p>
                </div>
                <div>
                    <p class="text-gray-600">IPK: 4.00</p>
                </div>
                <div>
                    <p class="text-gray-600">Maks.Beban SKS: 24 SKS</p>
                </div>
            </div>
        </div>

        <!-- Pencarian Mata Kuliah -->
        <div class="mb-6">
            <div class="relative">
                <input type="text" 
                       placeholder="Cari Mata Kuliah" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <button class="absolute right-3 top-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- List Mata Kuliah -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold">List Mata Kuliah</h2>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    <!-- Mata Kuliah Item -->
                    <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-medium">Proyek Perangkat Lunak</h3>
                            <p class="text-sm text-gray-600">PAIK6020 SMT 5 WAJIB</p>
                        </div>
                        <button class="p-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-medium">Pengembangan Berbasis Platform</h3>
                            <p class="text-sm text-gray-600">PAIK6020 SMT 5 WAJIB</p>
                        </div>
                        <button class="p-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-medium">Sistem Operasi</h3>
                            <p class="text-sm text-gray-600">PAIK6021 SMT 5 WAJIB</p>
                        </div>
                        <button class="p-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-medium">Metodologi Penelitian Ilmiah</h3>
                            <p class="text-sm text-gray-600">PAIK6021 SMT 7 WAJIB</p>
                        </div>
                        <button class="p-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal -->
        <div class="bg-white rounded-lg shadow">
            <div class="grid grid-cols-6 gap-4 p-4">
                <div class="font-semibold">Jam</div>
                <div class="font-semibold">Senin</div>
                <div class="font-semibold">Selasa</div>
                <div class="font-semibold">Rabu</div>
                <div class="font-semibold">Kamis</div>
                <div class="font-semibold">Jumat</div>
            </div>
            <div class="border-t">
                @php
                $jadwal = [
                    '07:00-09:30' => [
                        'Senin' => ['Pengembangan Berbasis Platform (A)', 'PAIK6023', 'SMT5'],
                        'Selasa' => ['Sistem Operasi (A)', 'PAIK6023', 'SMT5'],
                        'Rabu' => ['Sistem Operasi (C)', 'PAIK6023', 'SMT5'],
                        'Kamis' => null,
                        'Jumat' => ['Sistem Operasi (D)', 'PAIK6023', 'SMT5']
                    ],
                    '09:40-12:10' => [
                        'Senin' => null,
                        'Selasa' => ['Pengembangan Berbasis Platform (B)', 'PAIK6023', 'SMT5'],
                        'Rabu' => ['Pengembangan Berbasis Platform (D)', 'PAIK6023', 'SMT5'],
                        'Kamis' => ['Metodologi Penelitian Ilmiah (A)', 'PAIK6023', 'SMT7'],
                        'Jumat' => ['Metodologi Penelitian Ilmiah (D)', 'PAIK6023', 'SMT7']
                    ],
                    '13:00-15:30' => [
                        'Senin' => null,
                        'Selasa' => ['Pengembangan Berbasis Platform (C)', 'PAIK6023', 'SMT5'],
                        'Rabu' => ['Sistem Operasi (B)', 'PAIK6023', 'SMT5'],
                        'Kamis' => ['Metodologi Penelitian Ilmiah (B)', 'PAIK6023', 'SMT7'],
                        'Jumat' => ['Metodologi Penelitian Ilmiah (C)', 'PAIK6023', 'SMT7']
                    ]
                ];
                @endphp

                @foreach($jadwal as $jam => $hari)
                    <div class="grid grid-cols-6 gap-4 p-4 border-b">
                        <div class="text-sm font-medium">{{ $jam }}</div>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $namaHari)
                            <div class="text-sm">
                                @if(isset($hari[$namaHari]))
                                    <div class="p-2 bg-blue-50 rounded-lg">
                                        <p class="font-medium text-blue-700">{{ $hari[$namaHari][0] }}</p>
                                        <p class="text-xs text-blue-600">{{ $hari[$namaHari][1] }}</p>
                                        <p class="text-xs text-blue-500">{{ $hari[$namaHari][2] }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 