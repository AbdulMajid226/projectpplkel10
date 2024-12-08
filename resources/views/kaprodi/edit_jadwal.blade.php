@extends('layouts.kaprodi')

@section('content')
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    @endpush

    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Jadwal Kuliah</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Mata Kuliah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <select name="mata_kuliah" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('mata_kuliah') border-red-500 @enderror">
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($mataKuliahs as $mk)
                                <option value="{{ $mk->kode_mk }}" {{ $jadwal->kode_mk == $mk->kode_mk ? 'selected' : '' }}>
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
                            <div id="selected-dosen-container" class="space-y-2">
                                @foreach($jadwal->mataKuliah->pengampuanDosen as $selectedDosen)
                                    <div class="flex items-center justify-between bg-gray-100 p-2 rounded">
                                        <span>{{ $selectedDosen->nama }}</span>
                                        <button type="button" class="text-red-600 hover:text-red-800" data-dosen-id="{{ $selectedDosen->nidn }}">
                                            Hapus
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="dosen-hidden-inputs">
                                @foreach($jadwal->mataKuliah->pengampuanDosen as $selectedDosen)
                                    <input type="hidden" name="dosen[]" value="{{ $selectedDosen->nidn }}" id="dosen-input-{{ $selectedDosen->nidn }}">
                                @endforeach
                            </div>
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
                                <option value="{{ $k->kelas }}" {{ $jadwal->kelas == $k->kelas ? 'selected' : '' }}>
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
                                <option value="{{ $ta->thn_ajaran }}" {{ $jadwal->thn_ajaran == $ta->thn_ajaran ? 'selected' : '' }}>
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
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                                <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
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
                                <option value="{{ $waktu->id }}" {{ $jadwal->waktu_id == $waktu->id ? 'selected' : '' }}>
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
                                <option value="{{ $ruang->kode_ruang }}" {{ $jadwal->kode_ruang == $ruang->kode_ruang ? 'selected' : '' }}>
                                    {{ $ruang->kode_ruang }}
                                </option>
                            @endforeach
                        </select>
                        @error('ruang')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex space-x-3">
                    <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('buatjadwalkuliah') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dosenSelect = document.getElementById('dosen-select');
            const selectedDosenContainer = document.getElementById('selected-dosen-container');
            const hiddenInputsContainer = document.getElementById('dosen-hidden-inputs');
            const selectedDosens = new Set(Array.from(document.querySelectorAll('input[name="dosen[]"]')).map(input => input.value));

            // Remove selected dosens from dropdown
            Array.from(dosenSelect.options).forEach(option => {
                if (selectedDosens.has(option.value)) {
                    option.remove();
                }
            });

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

            // Add delete functionality to existing dosen tags
            document.querySelectorAll('#selected-dosen-container button').forEach(button => {
                button.addEventListener('click', function() {
                    const dosenId = this.dataset.dosenId;
                    const dosenName = this.parentElement.querySelector('span').textContent;
                    selectedDosens.delete(dosenId);
                    this.parentElement.remove();
                    document.getElementById(`dosen-input-${dosenId}`).remove();
                    
                    // Add option back to dropdown
                    const option = document.createElement('option');
                    option.value = dosenId;
                    option.text = dosenName;
                    dosenSelect.appendChild(option);
                    sortDropdownOptions();
                });
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
    </script>
    @endpush
@endsection