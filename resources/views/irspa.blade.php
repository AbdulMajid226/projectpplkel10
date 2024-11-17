<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Pengesahan IRS</x-slot:title>
</x-header>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <x-nav-bar>
            <x-slot:items>
                <x-nav-link href="/dashboardpa" :active="request()->is('dashboardpa')">Dashboard</x-nav-link>
                <x-nav-link href="/irspa" :active="request()->is('irspa')">Pengesahan IRS</x-nav-link>
                <x-nav-link href="/#" :active="request()->is('#')">KHS Mahasiswa</x-nav-link>
            </x-slot:items>
            <x-slot:name>Mulyono</x-slot:name>
            <x-slot:role>Pembimbing Akademik</x-slot:role>
        </x-nav-bar>

        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Informasi Pengisian IRS Mahasiswa -->
            <h1 class="text-[30px] font-bold">Pengesahan IRS</h1>
            <h1 class="font-semibold text-center text-[20px]">Ajuan IRS Mahasiswa <br> Semester Gasal Tahun Ajaran 2024/2025</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-collapse border-gray-300">
                    <thead>
                        <tr class="text-left bg-teal-500">
                            <th class="px-4 py-2 border border-gray-300">No</th>
                            <th class="px-4 py-2 border border-gray-300">Nama</th>
                            <th class="px-4 py-2 border border-gray-300">NIM</th>
                            <th class="px-4 py-2 border border-gray-300">Angkatan</th>
                            <th class="px-4 py-2 border border-gray-300">SKS</th>
                            <th class="px-4 py-2 border border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">1</td>
                            <td class="px-4 py-2 border border-gray-300">John Doe</td>
                            <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                            <td class="px-4 py-2 border border-gray-300">2022</td>
                            <td class="px-4 py-2 border border-gray-300">19</td>
                            <td class="px-4 py-2 border border-gray-300">Telah Disetujui <button class="px-4 py-2 ml-8 text-black bg-gray-300 rounded">Detail</button></td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">2</td>
                            <td class="px-4 py-2 border border-gray-300">Jane Smith</td>
                            <td class="px-4 py-2 border border-gray-300">24060122131124</td>
                            <td class="px-4 py-2 border border-gray-300">2022</td>
                            <td class="px-4 py-2 border border-gray-300">22</td>
                            <td class="px-4 py-2 border border-gray-300">Telah Disetujui <button class="px-4 py-2 ml-8 text-black bg-gray-300 rounded">Detail</button></td>
                        </tr>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">3</td>
                            <td class="px-4 py-2 border border-gray-300">Alice Brown</td>
                            <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                            <td class="px-4 py-2 border border-gray-300">2022</td>
                            <td class="px-4 py-2 border border-gray-300">24</td>
                            <td class="px-4 py-2 border border-gray-300"> <button class="px-4 py-2 text-white bg-gray-900 rounded">Setujui</button> <button class="px-4 py-2 ml-8 text-black bg-gray-300 rounded">Detail</button></td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
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
