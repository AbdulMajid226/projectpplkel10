@extends('layouts.kaprodi')

@section('content')
    <!-- Informasi Jadwal Kuliah -->
    <h1 class="text-lg font-bold">Informasi Jadwal Kuliah</h1>
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
            <p class="text-2xl font-bold">Ditolak</p>
            <p>10</p>
        </div>
    </div>
@endsection
