@extends('layouts.bagian_akademik')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Dashboard -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Bagian Akademik</h1>
                <p class="mt-2 text-gray-600">Selamat datang di panel kontrol bagian akademik</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 bg-teal-100 text-teal-800 rounded-full text-sm font-semibold">
                    Semester Ganjil 2024/2025
                </span>
            </div>
        </div>

        <!-- Informasi Pengajuan Ruang -->
        <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-white mb-6">Informasi Pengajuan Ruang</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Sudah Disetujui</p>
                            <p class="text-3xl font-bold text-gray-800">20</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Menunggu Persetujuan</p>
                            <p class="text-3xl font-bold text-gray-800">20</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 transform hover:scale-105 transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Ditolak</p>
                            <p class="text-3xl font-bold text-gray-800">10</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
