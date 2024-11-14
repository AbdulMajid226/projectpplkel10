<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembimbing Akademik</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <x-nav-bar>
            <x-slot:items>
                <a href="/dashboardpa" class="block py-2.5 px-4 rounded hover:bg-teal-700">Dasbor</a>
                <a href="irspa" class="block py-2.5 px-4 rounded hover:bg-teal-700">Pengesahan IRS</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">KHS Mahasiswa</a>
            </x-slot:items>
            <x-slot:name>Mulyono</x-slot:name>
            <x-slot:role>Pembimbing Akademik</x-slot:role>
        </x-nav-bar>

        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Informasi Pengisian IRS Mahasiswa -->
           <h1>Ini adalah halaman untuk cetak IRS</h1>
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
