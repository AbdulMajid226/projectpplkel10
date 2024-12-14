@extends('layouts.app')

@section('title', 'Dashboard Dosen PA')

@section('sidebar')
    <x-nav-link href="/dashboardpa" :active="request()->is('dashboardpa')">
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

    <x-nav-link href="/perwalian" :active="request()->is('perwalian')">
        <!-- Icon Perwalian -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300 transition duration-75 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span class="ms-3">Perwalian</span>
    </x-nav-link>
@endsection

@section('role')
    Dosen PA
@endsection
