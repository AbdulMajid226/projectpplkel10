@extends('layouts.app')

@section('title', 'Dashboard Dekan')

@section('sidebar')
    <x-nav-link href="/dashboard_dekan" :active="request()->is('dashboard_dekan')">
        <!-- Icon dashboard -->
        <svg class="w-6 h-6 text-gray-300 transition duration-75 group-hover:text-white " aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path
                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
            <path
                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
        </svg>
        <span class="ms-3">Dashboard</span>
    </x-nav-link>

    <x-nav-link href="/pengesahanruangkuliah" :active="request()->is('pengesahanruangkuliah')">
        <!-- Icon Pengesahan Ruang Kuliah -->
        <svg class="w-6 h-6 text-gray-300 transition duration-75 group-hover:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 18V6h-5v12h5Zm0 0h2M4 18h2.5m3.5-5.5V12M6 6l7-2v16l-7-2V6Z" />
        </svg>
        <span class="ms-3">Pengesahan Ruang Kuliah</span>
    </x-nav-link>

    <x-nav-link href="/pengesahanjadwalkuliah" :active="request()->is('pengesahanjadwalkuliah')">
        <!-- Icon Pengesahan Jadwal Kuliah -->
        <svg class="w-6 h-6 text-gray-300 group-hover:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
        </svg>
        <span class="ms-3">Pengesahan Jadwal Kuliah</span>
    </x-nav-link>
@endsection

@section('role')
    Dekan
@endsection
