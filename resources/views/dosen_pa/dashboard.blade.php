@extends('layouts.dosen_pa')

@section('content')
    <!-- Header Dashboard -->
    <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pembimbing Akademik</h1>
            <p class="mt-2 text-gray-600">Selamat datang di panel kontrol Pembimbing Akademik</p>
        </div>
        <div class="mt-4 md:mt-0">
            <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                Semester Ganjil 2024/2025
            </span>
        </div>
    </div>

    <!-- Informasi Tahun  >
    <div-- class="flex flex-wrap gap-4 mb-6">
        <select class="w-48 p-2 border rounded focus:outline-none focus:border-teal-500">
            <option>Pilih Tahun Ajaran</option>
            <option>2023/2024 Ganjil</option>
            <option>2023/2024 Genap</option>
            <option>2024/2025 Ganjil</option>
            <option>2024/2025 Genap</option>
        </select>
    </div-->

    <!-- Card Rekapan Status IRS -->
    <div class="p-6 mb-8 shadow-lg bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl">
        <h2 class="mb-6 text-xl font-semibold text-white">Informasi Pengisian IRS</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Card Belum Mengisi -->
            <div onclick="toggleTable('belum')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Belum Mengisi</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="belumMengisi">{{ $jumlahstatus['belumMengisi'] }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Menunggu Persetujuan -->
            <div onclick="toggleTable('menunggu')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="menungguPersetujuan">{{ $jumlahstatus['menungguPersetujuan'] }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Sudah Disetujui -->
            <div onclick="toggleTable('disetujui')" class="p-6 transition duration-200 transform bg-white shadow-md cursor-pointer rounded-xl hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">Sudah Disetujui</p>
                        <p class="text-3xl font-bold text-gray-800" data-status="disetujui">{{ $jumlahstatus['disetujui'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Belum Mengisi -->
    <div id="table-belum" class="hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr class="text-left">
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[30%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Status Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($irsData['belumMengisi'] as $index => $irs)
                    <tr class="min-w-full text-sm text-left text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->angkatan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Menunggu Persetujuan -->
    <div id="table-menunggu" class="hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr class="text-left">
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[30%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($irsData['menungguPersetujuan'] as $index => $irs)
                    <tr class="min-w-full text-sm text-left text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->angkatan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->total_sks ?? '-' }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <button
                                onclick="approveIRS({{ $irs->id }})"
                                class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">
                                Setujui
                            </button>
                            <button
                                class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600"
                                onclick="showDetail({{ $irs->id }})">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Sudah Disetujui -->
    <div id="table-disetujui" class="hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-collapse border-gray-300">
                <thead class="text-xs text-white uppercase bg-teal-600">
                    <tr class="text-left">
                        <th class="px-4 py-2 border border-gray-300 w-[3%]">No</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Nama</th>
                        <th class="px-4 py-2 border border-gray-300 w-[10%]">NIM</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">Angkatan</th>
                        <th class="px-4 py-2 border border-gray-300 w-[5%]">SKS</th>
                        <th class="px-4 py-2 border border-gray-300 w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($irsData['disetujui'] as $index => $irs)
                    <tr class="min-w-full text-sm text-left text-gray-700 hover:bg-gray-50">
                        <td class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nama }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->mahasiswa->angkatan }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $irs->total_sks ?? '-' }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <button
                                class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600"
                                onclick="showDetail({{ $irs->id }})">
                                Detail
                            </button>
                            <button
                                class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600"
                                onclick="cancelApproval({{ $irs->id }})">
                                Batalkan Persetujuan
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

            <!-- Modal Content -->
            <div class="relative z-50 w-full max-w-md p-6 mx-auto bg-white rounded-lg shadow-xl">
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modalTitle">
                        Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="modalMessage">
                            Apakah Anda yakin ingin menyetujui IRS ini?
                        </p>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmButton"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Ya, Setuju
                    </button>
                    <button type="button" id="cancelButton"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail IRS -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

            <!-- Modal Content -->
            <div class="relative z-50 w-full max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Detail IRS Mahasiswa</h3>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Informasi Mahasiswa -->
                <div class="p-4 mb-4 rounded-lg bg-gray-50">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nama Mahasiswa</p>
                            <p class="font-medium" id="detail-nama"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">NIM</p>
                            <p class="font-medium" id="detail-nim"></p>
                        </div>
                    </div>
                </div>

                <!-- Tabel Mata Kuliah -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kode MK</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Mata Kuliah</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">SKS</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Hari</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jam</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="detail-matkul">
                            <!-- Data akan diisi melalui JavaScript -->
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-right">
                    <button onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk toggle tabel -->
    <script>
        function showModal(title, message, confirmCallback) {
            const modal = document.getElementById('confirmModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const confirmButton = document.getElementById('confirmButton');
            const cancelButton = document.getElementById('cancelButton');

            modalTitle.textContent = title;
            modalMessage.textContent = message;

            // Show modal
            modal.classList.remove('hidden');

            // Handle confirm button
            confirmButton.onclick = () => {
                modal.classList.add('hidden');
                confirmCallback();
            };

            // Handle cancel button
            cancelButton.onclick = () => {
                modal.classList.add('hidden');
            };
        }

        function approveIRS(irsId) {
            showModal(
                'Konfirmasi Persetujuan',
                'Apakah Anda yakin ingin menyetujui IRS ini?',
                () => {
                    fetch(`/irs/approve/${irsId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update jumlah status
                            document.querySelector('[data-status="belumMengisi"]').textContent = data.newCounts.belumMengisi;
                            document.querySelector('[data-status="menungguPersetujuan"]').textContent = data.newCounts.menungguPersetujuan;
                            document.querySelector('[data-status="disetujui"]').textContent = data.newCounts.disetujui;

                            // Refresh halaman untuk memperbarui tabel
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyetujui IRS');
                    });
                }
            );
        }

        function cancelApproval(irsId) {
            showModal(
                'Konfirmasi Pembatalan',
                'Apakah Anda yakin ingin membatalkan persetujuan IRS ini?',
                () => {
                    fetch(`/irs/cancel/${irsId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update jumlah status
                            document.querySelector('[data-status="belumMengisi"]').textContent = data.newCounts.belumMengisi;
                            document.querySelector('[data-status="menungguPersetujuan"]').textContent = data.newCounts.menungguPersetujuan;
                            document.querySelector('[data-status="disetujui"]').textContent = data.newCounts.disetujui;

                            // Refresh halaman untuk memperbarui tabel
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat membatalkan persetujuan IRS');
                    });
                }
            );
        }

        function showDetail(irsId) {
            fetch(`/irs/${irsId}/detail`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(response => {
                    if (response.success) {
                        const data = response.data;

                        // Isi informasi mahasiswa
                        document.getElementById('detail-nama').textContent = data.nama;
                        document.getElementById('detail-nim').textContent = data.nim;

                        // Isi tabel mata kuliah
                        const tbody = document.getElementById('detail-matkul');
                        tbody.innerHTML = '';

                        data.jadwal.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${index + 1}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${item.kode_mk}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">${item.nama_mk}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${item.sks}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${item.hari}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${item.jam}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">${item.ruangan}</td>
                            `;
                            tbody.appendChild(row);
                        });

                        // Tampilkan modal
                        document.getElementById('detailModal').classList.remove('hidden');
                    } else {
                        throw new Error(response.message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail IRS: ' + error.message);
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function toggleTable(status) {
            // Sembunyikan semua tabel terlebih dahulu
            document.getElementById('table-belum').classList.add('hidden');
            document.getElementById('table-menunggu').classList.add('hidden');
            document.getElementById('table-disetujui').classList.add('hidden');

            // Tampilkan tabel yang dipilih
            document.getElementById('table-' + status).classList.remove('hidden');
        }
    </script>
@endsection
