@extends('layouts.kaprodi')

@section('content')

<div class="container px-4 py-8 mx-auto">
    <!-- Header Dashboard -->
    <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Kaprodi</h1>
            <p class="mt-2 text-gray-600">Selamat datang di panel kontrol Kaprodi</p>
        </div>
        <div class="mt-4 md:mt-0">
            <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                Semester Ganjil 2024/2025
            </span>
        </div>
    </div>

    <!-- Informasi Pengajuan Jadwal -->
    <div class="p-6 bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl shadow-lg">
        <h2 class="mb-6 text-xl font-semibold text-white">Informasi Pengajuan Jadwal</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Card Sudah Disetujui -->
            <div class="p-6 bg-white rounded-xl shadow-md transition duration-200 transform cursor-pointer hover:scale-105">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Sudah Disetujui</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $countJadwals['disetujui'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div class="p-6 bg-white rounded-xl shadow-md transition duration-200 transform cursor-pointer hover:scale-105">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $countJadwals['menunggu'] }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Ditolak -->
            <div class="p-6 bg-white rounded-xl shadow-md transition duration-200 transform cursor-pointer hover:scale-105">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Ditolak</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $countJadwals['ditolak'] }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
