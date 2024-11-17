<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Dashboard Mahasiswa</x-slot:title>
</x-header>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <x-nav-bar>
            <x-slot:items>
                <x-nav-link href="/dashboard_mhs" :active="request()->is('dashboard_mhs')">Dashboard</x-nav-link>
                <x-nav-link href="/#" :active="request()->is('#')">Registrasi</x-nav-link>
                <x-nav-link href="/#" :active="request()->is('#')">IRS</x-nav-link>
                <x-nav-link href="/#" :active="request()->is('#')">KHS</x-nav-link>
            </x-slot:items>
            <x-slot:name>Jokowi</x-slot:name>
            <x-slot:role>Mahasiswa</x-slot:role>
        </x-nav-bar>


        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Status Akademik -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="p-4 text-white bg-teal-600 rounded-lg">
                    <h2 class="text-lg font-semibold">Status akademik</h2>
                    <p class="text-2xl font-bold">Aktif</p>
                    <p>Semester Akademik: 2024/2025 Ganjil</p>
                    <p>Semester Studi: 5</p>
                    <p>Dosen Wali: Dr.Eng. Adi Wibowo, S.Si., M.Kom.<br>(NIP: 198203092006041002)</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Prestasi akademik</h2>
                    <div class="flex items-center justify-between mt-4">
                        <p>IPK: 3.81</p>
                        <p>SKS: 84</p>
                    </div>
                    <canvas id="chart" width="100" height="60"></canvas>
                </div>
            </div>

            <!-- Jadwal Kuliah -->
            <div>
                <h2 class="mb-4 text-2xl font-bold">Jadwal Hari Ini</h2>
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-white bg-teal-600">Mata Kuliah</th>
                                <th class="px-4 py-2 text-white bg-teal-600">Hari, Tanggal</th>
                                <th class="px-4 py-2 text-white bg-teal-600">Waktu</th>
                                <th class="px-4 py-2 text-white bg-teal-600">Ruang</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2">Rekayasa Perangkat Lunak</td>
                                <td class="px-4 py-2">Rabu, 4 September 2024</td>
                                <td class="px-4 py-2">09.40 - 12.10</td>
                                <td class="px-4 py-2">E101</td>

                            </tr>
                            <tr>
                                <td class="px-4 py-2">Manajemen Basis Data</td>
                                <td class="px-4 py-2">Rabu, 4 September 2024</td>
                                <td class="px-4 py-2">13.00 - 15.20</td>
                                <td class="px-4 py-2">E101</td>

                            </tr>
                            <tr>
                                <td class="px-4 py-2">Pemrograman Berorientasi Objek</td>
                                <td class="px-4 py-2">Rabu, 4 September 2024</td>
                                <td class="px-4 py-2">15.40 - 18.10</td>
                                <td class="px-4 py-2">A303</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
