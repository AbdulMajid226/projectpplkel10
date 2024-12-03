@extends('layouts.bagian_akademik')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <!-- Header Dashboard -->
        <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Bagian Akademik</h1>
                <p class="mt-2 text-gray-600">Selamat datang di panel kontrol bagian akademik</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                    Semester Ganjil 2024/2025
                </span>
            </div>
        </div>

        <!-- Informasi Pengajuan Ruang -->
        <div class="p-6 mb-8 bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl shadow-lg">
            <h2 class="mb-6 text-xl font-semibold text-white">Informasi Pengajuan Ruang</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Card Sudah Disetujui -->
                <div onclick="filterRooms('disetujui')" class="p-6 bg-white rounded-xl shadow-md transition duration-200 transform cursor-pointer hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="mb-1 text-sm text-gray-600">Sudah Disetujui</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $approvedCount }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Menunggu Persetujuan -->
                <div onclick="filterRooms('BelumDisetujui')" class="p-6 bg-white rounded-xl shadow-md transition duration-200 transform cursor-pointer hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="mb-1 text-sm text-gray-600">Menunggu Persetujuan</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $pendingCount }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Ditolak -->
                <div onclick="filterRooms('ditolak')" class="p-6 bg-white rounded-xl shadow-md transition duration-200 transform cursor-pointer hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="mb-1 text-sm text-gray-600">Ditolak</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $rejectedCount }}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Pengajuan Ruangan -->
        <div class="p-6 bg-white rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Pengajuan Ruangan</h2>
                <div id="statusFilter" class="flex gap-2">
                    <button onclick="filterRooms('all')" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 active-filter">
                        Semua
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kode Ruang</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Program Studi</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kuota</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="roomsList" class="bg-white divide-y divide-gray-200">
                        @foreach($ruangs as $ruang)
                        <tr class="room-item" data-status="{{ $ruang->status }}">
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->kode_ruang }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->programStudi->nama_prodi }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->kuota }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $ruang->status === 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $ruang->status === 'BelumDisetujui' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ruang->status === 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $ruang->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-3 text-sm font-medium whitespace-nowrap">
                                <button onclick="editRoom('{{ $ruang->kode_ruang }}')" class="text-teal-600 transition duration-200 hover:text-teal-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                @if($ruang->status !== 'disetujui')
                                <form action="{{ route('ruang.destroy', $ruang->kode_ruang) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 transition duration-200 hover:text-red-900"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ruang ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function filterRooms(status) {
            const rooms = document.querySelectorAll('.room-item');

            rooms.forEach(room => {
                if (status === 'all' || room.dataset.status === status) {
                    room.style.display = '';
                } else {
                    room.style.display = 'none';
                }
            });

        }
    </script>

    <style>
        .active-filter {
            background-color: #0d9488;
            color: white;
        }
    </style>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="relative bg-white rounded-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Ruang Kuliah</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="editForm" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Ruang</label>
                        <input type="text" name="kode_ruang" id="editKodeRuang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="program_studi" id="editProgramStudi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kuota</label>
                        <input type="number" name="kuota" id="editKuota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-md hover:bg-teal-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editRoom(kodeRuang) {
            fetch(`/ruang/${kodeRuang}/edit`)
                .then(response => response.json())
                .then(data => {
                    const ruang = data.ruang;
                    const programStudis = data.programStudis;

                    document.getElementById('editKodeRuang').value = ruang.kode_ruang;
                    document.getElementById('editKuota').value = ruang.kuota;

                    const selectElement = document.getElementById('editProgramStudi');
                    selectElement.innerHTML = '';
                    programStudis.forEach(prodi => {
                        const option = new Option(prodi.nama_prodi, prodi.kode_prodi);
                        option.selected = prodi.kode_prodi === ruang.kode_prodi;
                        selectElement.appendChild(option);
                    });

                    const form = document.getElementById('editForm');
                    form.action = `/ruang/${kodeRuang}`;

                    document.getElementById('editModal').classList.remove('hidden');
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                closeEditModal();
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
@endsection
