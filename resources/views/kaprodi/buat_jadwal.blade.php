@extends('layouts.kaprodi')
@use(App\Models\Jadwal)

@section('content')
    <!-- Add TomSelect CSS and JS in the head section -->
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    @endpush

    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Buat Jadwal Kuliah</h1>

        <!-- Form Buat Jadwal -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Mata Kuliah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <select name="mata_kuliah" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('mata_kuliah') border-red-500 @enderror">
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($mataKuliahs as $mk)
                                <option value="{{ $mk->kode_mk }}" {{ old('mata_kuliah') == $mk->kode_mk ? 'selected' : '' }}>
                                    {{ $mk->nama }} ({{ $mk->kode_mk }})
                                </option>
                            @endforeach
                        </select>
                        @error('mata_kuliah')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dosen Pengampu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Dosen Pengampu <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 space-y-2">
                            <select id="dosen-select" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('dosen') border-red-500 @enderror">
                                <option value="">Pilih Dosen</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                            @error('dosen')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <div id="selected-dosen-container" class="space-y-2"></div>
                            <div id="dosen-hidden-inputs"></div>
                        </div>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="kelas" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('kelas') border-red-500 @enderror">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->kelas }}" {{ old('kelas') == $k->kelas ? 'selected' : '' }}>
                                    {{ $k->kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Tahun Ajaran <span class="text-red-500">*</span>
                        </label>
                        <select name="thn_ajaran" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('thn_ajaran') border-red-500 @enderror">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->thn_ajaran }}" {{ old('thn_ajaran') == $ta->thn_ajaran ? 'selected' : '' }}>
                                    {{ $ta->thn_ajaran }}
                                </option>
                            @endforeach
                        </select>
                        @error('thn_ajaran')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hari -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Hari <span class="text-red-500">*</span>
                        </label>
                        <select name="hari" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('hari') border-red-500 @enderror">
                            <option value="">Pilih Hari</option>
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                        @error('hari')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Waktu <span class="text-red-500">*</span>
                        </label>
                        <select name="waktu_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('waktu_id') border-red-500 @enderror">
                            <option value="">Pilih Waktu</option>
                            @foreach($waktus as $waktu)
                                <option value="{{ $waktu->id }}" {{ old('waktu_id') == $waktu->id ? 'selected' : '' }}>
                                    {{ $waktu->jam_mulai }} - {{ $waktu->jam_selesai }}
                                </option>
                            @endforeach
                        </select>
                        @error('waktu_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ruang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Ruang <span class="text-red-500">*</span>
                        </label>
                        <select name="ruang" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('ruang') border-red-500 @enderror">
                            <option value="">Pilih Ruang</option>
                            @foreach($ruangs as $ruang)
                                @if($ruang->status === 'disetujui')
                                    <option value="{{ $ruang->kode_ruang }}" {{ old('ruang') == $ruang->kode_ruang ? 'selected' : '' }}>
                                        {{ $ruang->kode_ruang }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('ruang')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700">
                        Buat Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Jadwal -->
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Daftar Jadwal</h2>
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwals as $jadwal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->mataKuliah->nama ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($jadwal->mataKuliah)
                                        @foreach($jadwal->mataKuliah->pengampuanDosen ?? [] as $dosen)
                                            {{ $dosen->nama ?? '' }}<br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->kelas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->hari }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($jadwal->waktu)
                                        {{ $jadwal->waktu->jam_mulai }} - {{ $jadwal->waktu->jam_selesai }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->ruang->kode_ruang ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $jadwal->getStatusColorClass() }}">
                                        {{ $jadwal->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('jadwal.edit', $jadwal->id) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dosenSelect = document.getElementById('dosen-select');
            const selectedDosenContainer = document.getElementById('selected-dosen-container');
            const hiddenInputsContainer = document.getElementById('dosen-hidden-inputs');
            const selectedDosens = new Set();

            dosenSelect.addEventListener('change', function() {
                const selectedOption = dosenSelect.options[dosenSelect.selectedIndex];
                const dosenId = selectedOption.value;
                const dosenName = selectedOption.text;

                if (dosenId && !selectedDosens.has(dosenId)) {
                    selectedDosens.add(dosenId);
                    
                    // Create dosen tag
                    const dosenTag = document.createElement('div');
                    dosenTag.className = 'flex items-center justify-between bg-gray-100 p-2 rounded';
                    dosenTag.innerHTML = `
                        <span>${dosenName}</span>
                        <button type="button" class="text-red-600 hover:text-red-800" data-dosen-id="${dosenId}">
                            Hapus
                        </button>
                    `;

                    // Create hidden input
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'dosen[]';
                    hiddenInput.value = dosenId;
                    hiddenInput.id = `dosen-input-${dosenId}`;
                    
                    // Add delete functionality
                    dosenTag.querySelector('button').addEventListener('click', function() {
                        const dosenId = this.dataset.dosenId;
                        selectedDosens.delete(dosenId);
                        dosenTag.remove();
                        document.getElementById(`dosen-input-${dosenId}`).remove();
                        
                        // Add option back to dropdown
                        const option = document.createElement('option');
                        option.value = dosenId;
                        option.text = dosenName;
                        dosenSelect.appendChild(option);
                        sortDropdownOptions();
                    });

                    selectedDosenContainer.appendChild(dosenTag);
                    hiddenInputsContainer.appendChild(hiddenInput);

                    // Remove selected option from dropdown
                    selectedOption.remove();
                }

                // Reset select to placeholder
                dosenSelect.value = '';
            });

            // Function to sort dropdown options alphabetically
            function sortDropdownOptions() {
                const options = [...dosenSelect.options];
                options.shift(); // Remove placeholder option
                options.sort((a, b) => a.text.localeCompare(b.text));
                
                // Clear dropdown
                while (dosenSelect.options.length > 1) {
                    dosenSelect.remove(1);
                }
                
                // Add sorted options back
                options.forEach(option => dosenSelect.add(option));
            }
        });

        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');
        }
    </script>
    @endpush
@endsection
