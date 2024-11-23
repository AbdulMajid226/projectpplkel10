<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Dashboard Mahasiswa</x-slot:title>
</x-header>

<body class="bg-gray-100">
    <!--Navbar  -->
    <x-nav-bar>
        <x-slot:name>Mulyono</x-slot:name>
        <x-slot:role>Mahasiswa</x-slot:role>
    </x-nav-bar>

    <!--SideBar  -->
    <x-side-bar>
        <x-slot:items>
            <li>
                <a href="/dashboard_mhs"
                    class="flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-700 group">
                    <!-- Logo dashboard -->
                    <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-700 group">
                    <!-- Logo Ajukan Ruang Kuliah -->
                    <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>

                    <span class="ms-3">Registrasi</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-700 group">
                    <!-- Logo Kelola Ruang Kuliah -->
                    <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                    </svg>

                    <span class="ms-3">Buat IRS</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-700 group">
                    <!-- Logo Kelola Ruang Kuliah -->
                    <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                    </svg>

                    <span class="ms-3">IRS</span>
                </a>
            </li>
        </x-slot:items>
    </x-side-bar>


    <!-- Main Content -->
    <main class="flex-1 p-8 space-y-6 sm:ml-2 md:ml-60 lg:ml-60 mt-10">
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