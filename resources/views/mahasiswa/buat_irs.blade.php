@extends('layouts.mahasiswa')

@section('title', 'Buat IRS')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Buat IRS</h1>
            <h1 class="text-2xl font-bold text-gray-800">IRS (3sks)</h1>
        </div>

        <!-- Informasi Akademik -->
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-600">IP Semester Lalu: 4.00</p>
                </div>
                <div>
                    <p class="text-gray-600">IPK: 4.00</p>
                </div>
                <div>
                    <p class="text-gray-600">Maks.Beban SKS: 24 SKS</p>
                </div>
            </div>
        </div>

        <!-- Pencarian Mata Kuliah -->
        <div class="mb-6 relative">
            <div class="relative">
                <input type="text"
                       id="searchMataKuliah"
                       placeholder="Cari Mata Kuliah"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       autocomplete="off">
                <button class="absolute right-3 top-3">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Dropdown hasil pencarian -->
            <div id="searchResults" class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-lg hidden">
                <div class="p-2 space-y-2 max-h-60 overflow-y-auto">
                    @if($mataKuliah && $mataKuliah->count() > 0)
                        @foreach($mataKuliah as $mk)
                        <div class="p-3 hover:bg-gray-50 rounded-lg cursor-pointer mata-kuliah-item"
                             data-kode="{{ $mk->kode_mk }}"
                             data-nama="{{ $mk->nama }}"
                             data-sks="{{ $mk->sks }}">
                            <h3 class="font-medium">{{ $mk->nama }}</h3>
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-600">{{ $mk->kode_mk }} SMT {{ $mk->semester }} {{ strtoupper($mk->sifat) }}</p>
                                <p class="text-sm text-gray-500">{{ $mk->sks }} SKS</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-3 text-center text-gray-500">
                            Tidak ada mata kuliah yang tersedia
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- List Mata Kuliah yang Dipilih -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold">List Mata Kuliah</h2>
            </div>
            <div class="p-4">
                <div class="space-y-3" id="selectedMataKuliah">
                    <!-- Mata kuliah yang dipilih akan ditampilkan di sini -->
                </div>
            </div>
        </div>

        <!-- Jadwal -->
        <div class="bg-white rounded-lg shadow">
            <div class="grid grid-cols-6 border-b">
                <div class="p-4 font-semibold">Jam</div>
                <div class="p-4 font-semibold">Senin</div>
                <div class="p-4 font-semibold">Selasa</div>
                <div class="p-4 font-semibold">Rabu</div>
                <div class="p-4 font-semibold">Kamis</div>
                <div class="p-4 font-semibold">Jumat</div>
            </div>

            @php
            $waktu = [
                '07:00' => ['height' => 60],
                '08:00' => ['height' => 60],
                '09:00' => ['height' => 60],
                '10:00' => ['height' => 60],
                '11:00' => ['height' => 60],
                '12:00' => ['height' => 60],
                '13:00' => ['height' => 60],
                '14:00' => ['height' => 60],
                '15:00' => ['height' => 60],
                '16:00' => ['height' => 60],
            ];

            $jadwal = [
                [
                    'nama' => 'Proyek Perangkat Lunak',
                    'kode' => 'WAJIB (PAIK6023)',
                    'kelas' => 'Kelas : C 3/3 SKS',
                    'waktu' => '07:00 - 09:30',
                    'hari' => 'Kamis'
                ],
                [
                    'nama' => 'Proyek Perangkat Lunak',
                    'kode' => 'WAJIB (PAIK6023)',
                    'kelas' => 'Kelas : D 3/3 SKS',
                    'waktu' => '09:40 - 12:10',
                    'hari' => 'Kamis'
                ],
                [
                    'nama' => 'Proyek Perangkat Lunak',
                    'kode' => 'WAJIB (PAIK6023)',
                    'kelas' => 'Kelas : B 3/3 SKS',
                    'waktu' => '13:00 - 15:30',
                    'hari' => 'Rabu'
                ],
                [
                    'nama' => 'Proyek Perangkat Lunak',
                    'kode' => 'WAJIB (PAIK6023)',
                    'kelas' => 'Kelas : A 3/3 SKS',
                    'waktu' => '08:40 - 12:10',
                    'hari' => 'Jumat'
                ],
            ];
            @endphp

            <div class="grid grid-cols-6 relative">
                <!-- Kolom waktu -->
                <div class="border-r">
                    @foreach($waktu as $jam => $config)
                        <div class="border-b h-[60px] px-4 py-2 text-sm">
                            {{ $jam }}
                        </div>
                    @endforeach
                </div>

                <!-- Kolom hari -->
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                    <div class="border-r relative">
                        @foreach($jadwal as $kelas)
                            @if($kelas['hari'] == $hari)
                                @php
                                    $waktuMulai = explode(' - ', $kelas['waktu'])[0];
                                    $waktuSelesai = explode(' - ', $kelas['waktu'])[1];
                                    $jamMulai = (int) explode(':', $waktuMulai)[0];
                                    $menitMulai = (int) explode(':', $waktuMulai)[1];
                                    $jamSelesai = (int) explode(':', $waktuSelesai)[0];
                                    $menitSelesai = (int) explode(':', $waktuSelesai)[1];

                                    $topPosition = ($jamMulai - 7) * 60 + $menitMulai;
                                    $height = ($jamSelesai - $jamMulai) * 60 + ($menitSelesai - $menitMulai);
                                @endphp

                                <div class="absolute w-[95%] mx-1 bg-gray-100 rounded-lg p-2 text-xs"
                                     style="top: {{ $topPosition }}px; height: {{ $height }}px;">
                                    <p class="font-medium">{{ $kelas['nama'] }}</p>
                                    <p class="text-gray-600">{{ $kelas['kode'] }}</p>
                                    <p class="text-gray-600">{{ $kelas['kelas'] }}</p>
                                    <p class="text-gray-500">{{ $kelas['waktu'] }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchMataKuliah');
    const searchResults = document.getElementById('searchResults');
    const mataKuliahItems = document.querySelectorAll('.mata-kuliah-item');
    const selectedMataKuliah = document.getElementById('selectedMataKuliah');
    const selectedItems = new Set(); // Untuk menyimpan kode MK yang sudah dipilih

    // Tampilkan dropdown saat input difokuskan
    searchInput.addEventListener('focus', () => {
        searchResults.classList.remove('hidden');
    });

    // Sembunyikan dropdown saat klik di luar area pencarian
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });

    // Filter hasil pencarian saat mengetik
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();

        mataKuliahItems.forEach(item => {
            const nama = item.getAttribute('data-nama').toLowerCase();
            const kode = item.getAttribute('data-kode').toLowerCase();

            if (nama.includes(searchTerm) || kode.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Tampilkan dropdown jika ada input
        if (searchTerm) {
            searchResults.classList.remove('hidden');
        }
    });

    // Event click untuk setiap item mata kuliah
    mataKuliahItems.forEach(item => {
        item.addEventListener('click', () => {
            const kode = item.getAttribute('data-kode');

            // Cek apakah mata kuliah sudah dipilih
            if (selectedItems.has(kode)) {
                alert('Mata kuliah ini sudah dipilih!');
                return;
            }

            const nama = item.getAttribute('data-nama');
            const sks = item.getAttribute('data-sks');

            // Tambahkan ke Set
            selectedItems.add(kode);

            // Buat elemen baru untuk mata kuliah yang dipilih
            const newItem = document.createElement('div');
            newItem.className = 'flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg';
            newItem.setAttribute('data-kode', kode);
            newItem.innerHTML = `
                <div>
                    <h3 class="font-medium">${nama}</h3>
                    <p class="text-sm text-gray-600">${kode} SMT ${item.querySelector('p').textContent.split(' ')[2]} ${item.querySelector('p').textContent.split(' ')[3]}</p>
                </div>
                <button class="p-2 delete-mk" onclick="deleteMataKuliah('${kode}')">
                    <svg class="w-5 h-5 text-red-400 hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            `;

            // Tambahkan ke list mata kuliah yang dipilih
            selectedMataKuliah.appendChild(newItem);

            // Bersihkan input dan sembunyikan dropdown
            searchInput.value = '';
            searchResults.classList.add('hidden');
        });
    });

    // Fungsi untuk menghapus mata kuliah yang dipilih
    function deleteMataKuliah(kode) {
        const itemToDelete = selectedMataKuliah.querySelector(`[data-kode="${kode}"]`);
        if (itemToDelete) {
            selectedItems.delete(kode); // Hapus dari Set
            itemToDelete.remove();
        }
    }
</script>
@endpush
