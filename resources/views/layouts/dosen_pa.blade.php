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

    <x-nav-link href="/irspa" :active="request()->is('irspa')">
        <!-- Icon Pengesahan IRS -->
        <svg class="w-6 h-6 text-gray-300 transition duration-75 group-hover:text-white" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
        <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
        <path fill-rule="evenodd"
            d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
            clip-rule="evenodd" />
    </svg>
        <span class="ms-3">Pengesahan IRS</span>
    </x-nav-link>
@endsection

@section('role')
    Dosen PA
@endsection
