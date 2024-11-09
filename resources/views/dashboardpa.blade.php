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
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 text-white bg-teal-800">
            <div class="flex items-center p-4 space-x-2">
                <img src="{{ asset('images/logo_simak_only.png') }}" alt="SIMAK Logo" class="w-10 h-10">
                <span class="text-xl font-semibold">SIMAK Undip</span>
            </div>
            <nav class="flex-1 px-4">
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">Dasbor</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">Pengesahan IRS</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">KHS Mahasiswa</a>
            </nav>
            <div class="flex items-center p-4 space-x-2 border-t border-teal-700">
                <img src="{{ asset('images/Profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full">
                <div>
                    <span>Mulyono </span>
                    <span class="text-sm">Pembimbing Akademik</span>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full py-2.5 px-4 text-left rounded hover:bg-teal-700 text-white">Logout</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Informasi Pengisian IRS Mahasiswa -->
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