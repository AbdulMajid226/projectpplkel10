<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Ajukan Ruang Kuliah</x-slot:title>
</x-header>

<body class="bg-white">
    <!--Navbar  -->
    <x-nav-bar>
        <x-slot:name>{{ Auth::user()->name }}</x-slot:name>
        <x-slot:email>{{ Auth::user()->email }}</x-slot:email>
        <x-slot:role>Bagian Akademik</x-slot:role>
    </x-nav-bar>


    <!--SideBar  -->
    <x-side-bar>
        <x-slot:items>

            <x-nav-link href="/dashboard_bagianAkademik" :active="request()->is('dashboard_bagianAkademik')">
                <!-- Icon dashboard -->
                <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white " aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                    <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                </svg>
                <span class="ms-3">Dashboard</span>
            </x-nav-link>

            <x-nav-link href="/ajukanruangkuliah" :active="request()->is('ajukanruangkuliah')">
                <!-- Icon Ajukan Ruang Kuliah -->
                <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 18V6h-5v12h5Zm0 0h2M4 18h2.5m3.5-5.5V12M6 6l7-2v16l-7-2V6Z" />
                </svg>

                <span class="ms-3">Ajukan Ruang Kuliah</span>
            </x-nav-link>

            <x-nav-link href="/kelolaruangkuliah" :active="request()->is('kelolaruangkuliah')">
                <!-- Icon Kelola Ruang Kuliah -->
                <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white " aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ms-3">Kelola Ruang Kuliah</span>
            </x-nav-link>

        </x-slot:items>
    </x-side-bar>


    <!-- Main Content -->
    <main class="p-8 mt-10 space-y-6 sm:ml-2 md:ml-60 lg:ml-60">
        <h1>ini adalah halaman ajukan ruang kuliah</h1>
    </main>
</body>

</html>
