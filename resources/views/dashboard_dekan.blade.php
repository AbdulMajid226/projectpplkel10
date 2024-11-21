<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Dashboard Dekan</x-slot:title>
</x-header>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <x-nav-bar>
            <x-slot:items>
                <x-nav-link href="/dashboard_dekan" :active="request()->is('dashboard_dekan')">
                    Dashboard
                </x-nav-link>
                <x-nav-link href="" :active="request()->is('')">Pengesahan Ruang Kuliah</x-nav-link>
                <x-nav-link href="" :active="request()->is('')">Pengesahan Jadwal Kuliah</x-nav-link>

            </x-slot:items>
            <x-slot:name>Mulyono</x-slot:name>
            <x-slot:role>Dekan</x-slot:role>
        </x-nav-bar>

        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Informasi Pengesahan Ruang Kuliah -->

            <h1 class="text-lg font-bold">Informasi Pengesahan Ruang Kuliah</h1>

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

            <!-- Informasi Pengesahan Jadwal Kuliah -->

            <h1 class="text-lg font-bold">Informasi Pengesahan Jadwal Kuliah</h1>

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