<!DOCTYPE html>
<html lang="en">

<x-header>
    <x-slot:title>Dashboard Pembimbing Akademik</x-slot:title>
</x-header>

<body class="bg-gray-100">
    <!--Navbar  -->
    <x-nav-bar>
        <x-slot:name>Mulyono</x-slot:name>
        <x-slot:role>Pembimbing Akademik</x-slot:role>
    </x-nav-bar>

    <!--SideBar  -->
    <x-side-bar>
        <x-slot:items>
            <li>
                <a href="/dashboardpa" class="flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-700 group">
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
                <a href="/irspa" class="flex items-center p-2 text-gray-100  rounded-lg hover:bg-teal-700 group">
                    <!-- Logo Ajukan Ruang Kuliah -->
                    <svg class="w-6 h-6 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                        <path fill-rule="evenodd"
                            d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                            clip-rule="evenodd" />
                    </svg>


                    <span class="ms-3">Pengesahan IRS</span>
                </a>
            </li>
        </x-slot:items>
    </x-side-bar>

    <!-- Main Content -->
    <main class="flex-1 p-8 space-y-6 sm:ml-2 md:ml-60 lg:ml-60 mt-10">
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