@extends('layouts.bagian_akademik')

@section('title', 'Ajukan Ruang Kuliah')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Ajukan Ruang Kuliah</h1>
            <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
                Semester Ganjil 2024/2025
            </span>
        </div>

        <!-- Form Ajukan Ruang -->
        <div class="p-8 bg-white rounded-xl border border-gray-100 shadow-md">
            <form action="{{ route('ajukanruang.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Kode Ruang</label>
                        <input type="text" name="kode_ruang"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                            placeholder="Masukkan kode ruang" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Program Studi</label>
                        <select name="program_studi"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="IF">Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                            <option value="TI">Teknik Industri</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Kuota Fisik</label>
                        <input type="number" name="kuota"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                            placeholder="Masukkan jumlah kuota" required>
                    </div>
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="flex gap-2 items-center px-6 py-3 text-white bg-teal-600 rounded-lg transition duration-200 hover:bg-teal-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Ajukan Ruang
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Pengajuan -->
        <div class="mt-12">
            <h2 class="mb-6 text-2xl font-bold text-gray-800">Daftar Pengajuan Ruang</h2>
            <div class="overflow-hidden bg-white rounded-xl border border-gray-100 shadow-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Kode Ruang</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Program Studi</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Kuota</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($ruangs as $ruang)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->kode_ruang }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->programStudi->nama_prodi }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ruang->kuota }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($ruang->status == 'disetujui')
                                            <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                                {{ $ruang->status }}
                                            </span>
                                        @elseif($ruang->status == 'ditolak')
                                            <span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                                {{ $ruang->status }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                                {{ $ruang->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 space-x-3 text-sm font-medium whitespace-nowrap">
                                        <button onclick="editRoom('{{ $ruang->kode_ruang }}')" class="text-teal-600 transition duration-200 hover:text-teal-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        @if($ruang->status != 'disetujui')
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

        @if(session('success'))
            <div class="relative px-4 py-3 text-green-700 bg-green-100 rounded border border-green-400" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>
@endsection

<!-- Modal Edit -->
<div id="editModal" class="hidden overflow-y-auto fixed inset-0 z-50">
    <div class="flex justify-center items-center px-4 min-h-screen">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative p-6 w-full max-w-md bg-white rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Edit Ruang Kuliah</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="editForm" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Ruang</label>
                    <input type="text" name="kode_ruang" id="editKodeRuang" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select name="program_studi" id="editProgramStudi" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kuota</label>
                    <input type="number" name="kuota" id="editKuota" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div class="flex gap-3 justify-end">
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
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.message) {
                alert(data.message);
            }
            closeEditModal();
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data');
        });
    });
</script>
