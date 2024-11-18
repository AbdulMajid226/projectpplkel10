<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Dashboard Pembimbing Akademik</x-slot:title>
</x-header>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <x-nav-bar>
            <x-slot:items>
                <x-nav-link href="/dashboardpa" :active="request()->is('dashboardpa')">Dashboard</x-nav-link>
                <x-nav-link href="/irspa" :active="request()->is('irspa')">Pengesahan IRS</x-nav-link>

            </x-slot:items>
            <x-slot:name>Mulyono</x-slot:name>
            <x-slot:role>Pembimbing Akademik</x-slot:role>
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
            <h1 class="text-lg font-bold">Informasi Pengisian IRS Mahasiswa</h1>
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
                    <p class="text-2xl font-bold">Belum IRS</p>
                    <p>10</p>
                </div>
            </div>

            <!-- Jadwal Kuliah -->
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5'],
            datasets: [{
                label: 'IPK',
                data: [3.5, 3.6, 3.7, 3.75, 3.81],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
            }]
        }
    });
    </script>

</body>

</html>