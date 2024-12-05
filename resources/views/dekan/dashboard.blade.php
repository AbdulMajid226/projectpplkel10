<?php
// Isi dari dashboard_dekan.blade.php
?>
<!DOCTYPE html>
<html lang="en">

@extends('layouts.dekan')

@section('title', 'Dashboard Dekan')

@section('content')
    <!-- Informasi Pengajuan Ruang -->
    <h1 class="text-lg font-bold">Informasi Pengajuan Ruang</h1>
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

    <!-- Informasi Pengajuan Jadwal -->
    <div class="mt-8">
        <h1 class="text-lg font-bold">Informasi Pengajuan Jadwal</h1>
        <h1 class="text-lg font-semibold">Semester Ganjil 2024/2025</h1>
        <div class="grid grid-cols-1 gap-4 p-3 bg-teal-600 rounded-lg shadow md:grid-cols-3">
            <div class="p-4 text-center bg-white rounded-lg shadow">
                <p class="text-2xl font-bold">Sudah Disetujui</p>
                <p>15</p>
            </div>
            <div class="p-4 text-center bg-white rounded-lg shadow">
                <p class="text-2xl font-bold">Menunggu Persetujuan</p>
                <p>25</p>
            </div>
            <div class="p-4 text-center bg-white rounded-lg shadow">
                <p class="text-2xl font-bold">Ditolak</p>
                <p>5</p>
            </div>
        </div>
    </div>
@endsection

</html>
