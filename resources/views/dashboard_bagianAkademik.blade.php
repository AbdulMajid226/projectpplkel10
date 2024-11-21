<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Dashboard Bagian Akademik</x-slot:title>
</x-header>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <x-nav-bar>
            <x-slot:items>
                <x-nav-link href="/dashboard_bagiankAkademik" :active="request()->is('dashboard_bagiankAkademik')">
                    Dashboard
                </x-nav-link>
                <x-nav-link href="" :active="request()->is('')">Ajukan Ruang Kuliah</x-nav-link>
                <x-nav-link href="" :active="request()->is('')">Kelola Ruang Kuliah</x-nav-link>

            </x-slot:items>
            <x-slot:name>Mulyono</x-slot:name>
            <x-slot:role>Bagian Akademik</x-slot:role>
        </x-nav-bar>

        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Informasi Pengisian IRS Mahasiswa -->
            <x-dropdown>
                <x-slot:trigger> <button class="px-4 py-2 text-white bg-blue-600 rounded">Pilih Tahun Ajaran</button>
                    </x-slot:>
                    <x-slot:content>
                        <x-dropdown-item>Opsi 1</x-dropdown-item>
                        <x-dropdown-item>Opsi 2</x-dropdown-item>
                        <x-dropdown-item>Opsi 3</x-dropdown-item>
                        </x-slot>
            </x-dropdown>
            <h1 class="text-lg font-bold">Informasi Pengajuan Ruang</h1>
            <h1 class="text-lg font-semibold">Semester Ganjil 2024/2025</h1>
            <div class="grid grid-cols-1 gap-4 p-3 bg-teal-600 rounded-lg shadow md:grid-cols-3">
                <div class="p-4 text-center bg-white rounded-lg shadow">
                    <p class="text-2xl font-bold">Sudah Disetujui</p>
                    <p>20</p>
                </div>
                <div class="p-4 text-center bg-white rounded-lg shadow">
                    <p class="text-2xl font-bold">Belum Disetujui</p>
                    <p>20</p>
                </div>
                <div class="p-4 text-center bg-white rounded-lg shadow">
                    <p class="text-2xl font-bold">Ditolak</p>
                    <p>10</p>
                </div>
            </div>


        </main>
    </div>


</body>

</html>