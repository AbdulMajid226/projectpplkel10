<?php
// Isi dari dashboard_dekan.blade.php
?>
<!DOCTYPE html>
<html lang="en">

@extends('layouts.dekan')

@section('title', 'Dashboard Dekan')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Dekan</h1>
            <p class="mt-2 text-gray-600">Selamat datang di panel kontrol Dekan</p>
        </div>
        <div class="mt-4 md:mt-0">
            <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                Semester Ganjil 2024/2025
            </span>
        </div>
    </div>
    
    {{-- Informasi Pengajuan Ruang --}}
    <div class="p-6 mb-10 shadow-lg bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl">
        <h2 class="mb-6 text-xl font-semibold text-white">Informasi Pengajuan Ruang</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Card Belum Mengisi -->
            <div onclick="toggleTable('belum')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Ditolak</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="belumMengisi">{{ $countRuangs['ditolak'] }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div onclick="toggleTable('menunggu')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="menungguPersetujuan">{{ $countRuangs['menunggu'] }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Sudah Disetujui -->
            <div onclick="toggleTable('disetujui')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Sudah Disetujui</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="disetujui">{{ $countRuangs['disetujui'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi Pengajuan Jadwal --}}
    <div class="p-6 mb-8 shadow-lg bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl">
        <h2 class="mb-6 text-xl font-semibold text-white">Informasi Pengajuan Jadwal</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Card Belum Mengisi -->
            <div onclick="toggleTable('belum')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Ditolak</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="belumMengisi">{{ $countJadwals['ditolak'] }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div onclick="toggleTable('menunggu')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="menungguPersetujuan">{{ $countJadwals['menunggu'] }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Sudah Disetujui -->
            <div onclick="toggleTable('disetujui')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Sudah Disetujui</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="disetujui">{{ $countJadwals['disetujui'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Pengajuan Ruang -->
    {{-- <div class="p-6 mb-8 shadow-lg bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-white">Informasi Pengajuan Ruang</h2>
            <span class="text-sm font-medium text-white">Semester Ganjil 2024/2025</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Sudah Disetujui -->
            <div class="bg-gray-50 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Sudah Disetujui</h3>
                        <p class="text-3xl font-bold text-gray-800">20</p>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div class="bg-gray-50 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Menunggu Persetujuan</h3>
                        <p class="text-3xl font-bold text-gray-800">20</p>
                    </div>
                </div>
            </div>

            <!-- Card Ditolak -->
            <div class="bg-gray-50 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Ditolak</h3>
                        <p class="text-3xl font-bold text-gray-800">10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Pengajuan Jadwal -->
    <div class="p-6 mb-8 shadow-lg bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-white">Informasi Pengajuan Jadwal</h2>
            <span class="text-sm font-medium text-white">Semester Ganjil 2024/2025</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Sudah Disetujui -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Sudah Disetujui</h3>
                        <p class="text-3xl font-bold text-gray-800">15</p>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Menunggu Persetujuan</h3>
                        <p class="text-3xl font-bold text-gray-800">25</p>
                    </div>
                </div>
            </div>

            <!-- Card Ditolak -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Ditolak</h3>
                        <p class="text-3xl font-bold text-gray-800">5</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

</html>
