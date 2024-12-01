@extends('layouts.dosen_pa')

@section('content')
    <!-- Informasi Pengisian IRS Mahasiswa -->
    <x-dropdown>
        <x-slot:trigger>
            <button class="px-4 py-2 text-white bg-blue-600 rounded">Pilih Tahun Ajaran</button>
        </x-slot:trigger>
        <x-slot:content>
            <x-dropdown-item>Opsi 1</x-dropdown-item>
            <x-dropdown-item>Opsi 2</x-dropdown-item>
            <x-dropdown-item>Opsi 3</x-dropdown-item>
        </x-slot:content>
    </x-dropdown>

    <h1 class="text-lg font-bold">Informasi Pengisian IRS</h1>
    <h1 class="text-lg font-semibold">Semester Ganjil 2024/2025</h1>
    <div class="grid grid-cols-1 gap-4 p-3 bg-teal-600 rounded-lg shadow md:grid-cols-3">
        <div class="p-4 text-center bg-white rounded-lg shadow">
            <p class="text-2xl font-bold">Sudah Disetujui</p>
            <p>20</p>
        </div>
        <div class="p-4 text-center bg-white rounded-lg shadow">
            <p class="text-2xl font-bold">Menunggu Persetujuan</p>
            <p>20</p>
        </div>
        <div class="p-4 text-center bg-white rounded-lg shadow">
            <p class="text-2xl font-bold">Belum Mengisi</p>
            <p>10</p>
        </div>
    </div>
@endsection
