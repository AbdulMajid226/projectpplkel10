<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Pengesahan IRS</x-slot:title>
</x-header>

<body class="bg-gray-100">

    <!--Navbar  -->
    <x-nav-bar>
        <x-slot:name>{{ Auth::user()->name }}</x-slot:name>
        <x-slot:email>{{ Auth::user()->email }}</x-slot:email>
        <x-slot:role>Pembimbing Akademik</x-slot:role>
    </x-nav-bar>

    <!--SideBar  -->
    <x-side-bar>
        <x-slot:items>

            <x-nav-link href="/dashboardpa" :active="request()->is('dashboardpa')">
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

            <x-nav-link href="/irspa" :active="request()->is('irspa')">
                <!-- Icon Pengesahan IRS -->
                <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                    <path fill-rule="evenodd"
                        d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ms-3">Pengesahan IRS</span>
            </x-nav-link>

        </x-slot:items>
    </x-side-bar>


    <!-- Main Content -->
    <main class="flex-1 p-8 mt-10 space-y-6 sm:ml-2 md:ml-60 lg:ml-60">
        <!-- Informasi Pengisian IRS Mahasiswa -->
        <h1 class="text-[30px] font-bold">Pengesahan IRS</h1>
        <h1 class="font-semibold text-center text-[20px]">Ajuan IRS Mahasiswa <br> Semester Gasal Tahun Ajaran
            2024/2025</h1>
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
                        <th class="px-4 py-2 border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">1</td>
                        <td class="px-4 py-2 border border-gray-300">John Doe</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">19</td>
                        <td class="px-4 py-2 border border-gray-300"><button class="px-4 py-2 ml-2 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Telah Disetujui </td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">2</td>
                        <td class="px-4 py-2 border border-gray-300">Jane Smith</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131124</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">22</td>
                        <td class="px-4 py-2 border border-gray-300"><button class="px-4 py-2 ml-2 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Telah Disetujui </td>
                    </tr>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">3</td>
                        <td class="px-4 py-2 border border-gray-300">Alice Brown</td>
                        <td class="px-4 py-2 border border-gray-300">24060122131123</td>
                        <td class="px-4 py-2 border border-gray-300">2022</td>
                        <td class="px-4 py-2 border border-gray-300">24</td>
                        <td class="px-4 py-2 border border-gray-300"> <button
                                class="px-4 py-2 text-white bg-gray-900 rounded">Setujui</button> <button
                                class="px-4 py-2 ml-8 text-black bg-gray-300 rounded">Detail</button></td>
                        <td class="px-4 py-2 border border-gray-300">Belum Disetujui </td>
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
