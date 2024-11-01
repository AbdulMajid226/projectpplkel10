<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-teal-800 text-white flex flex-col">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('images/logo_simak_only.png') }}" alt="SIMAK Logo" class="h-10 w-10">
                <span class="text-xl font-semibold">SIMAK Undip</span>
            </div>
            <nav class="flex-1 px-4">
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">Dasbor</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">Registrasi</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">IRS</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-teal-700">KHS</a>
            </nav>
            <div class="p-4 flex items-center space-x-2 border-t border-teal-700">
                <img src="{{ asset('images/Profile.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
                <div>
                    <span>Jokowi </span>
                    <span class="text-sm">Mahasiswa</span>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 space-y-6">
            <!-- Status Akademik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-teal-600 text-white p-4 rounded-lg">
                    <h2 class="text-lg font-semibold">Status akademik</h2>
                    <p class="text-2xl font-bold">Aktif</p>
                    <p>Semester Akademik: 2024/2025 Ganjil</p>
                    <p>Semester Studi: 5</p>
                    <p>Dosen Wali: Dr.Eng. Adi Wibowo, S.Si., M.Kom.<br>(NIP: 198203092006041002)</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Prestasi akademik</h2>
                    <div class="flex justify-between items-center mt-4">
                        <p>IPK: 3.81</p>
                        <p>SKS: 84</p>
                    </div>
                    <canvas id="chart" width="100" height="60"></canvas>
                </div>
            </div>

            <!-- Jadwal Kuliah -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Jadwal Hari Ini</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 bg-teal-600 text-white">Mata Kuliah</th>
                                <th class="px-4 py-2 bg-teal-600 text-white">Hari, Tanggal</th>
                                <th class="px-4 py-2 bg-teal-600 text-white">Waktu</th>
                                <th class="px-4 py-2 bg-teal-600 text-white">Ruang</th>

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