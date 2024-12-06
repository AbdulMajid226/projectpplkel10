@extends('layouts.mahasiswa')

@section('title', 'Buat IRS')

@section('content')
    @if(Auth::user()->mahasiswa->status !== 'Aktif')
        <div class="flex flex-col justify-center items-center py-6 min-h-screen bg-gray-100">
            <div class="p-8 text-center bg-white rounded-lg shadow-md">
                <svg class="mx-auto w-16 h-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <h2 class="mt-4 text-xl font-semibold text-gray-800">Anda Belum Bisa Membuat IRS</h2>
                <p class="mt-2 text-gray-600">Status anda saat ini: {{ Auth::user()->mahasiswa->status }}</p>
                <p class="mt-1 text-gray-600">Silahkan selesaikan registrasi terlebih dahulu</p>
                <a href="{{ route('registrasi_mhs') }}"
                   class="inline-block px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg transition-colors hover:bg-blue-600">
                    Lakukan Registrasi
                </a>
            </div>
        </div>
    @else
        <div class="container px-4 py-6 mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Buat IRS</h1>
                <h1 class="text-2xl font-bold text-gray-800">IRS (3sks)</h1>
            </div>

            <div class="flex gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-6 w-1/3">
                    <!-- Informasi Akademik -->
                    <div class="p-4 bg-white rounded-lg shadow">
                        <h2 class="mb-4 text-lg font-semibold">Informasi Akademik</h2>
                        <div class="space-y-2">
                            <p class="text-gray-600">IP Semester Lalu: 4.00</p>
                            <p class="text-gray-600">IPK: 4.00</p>
                            <p class="text-gray-600">Maks.Beban SKS: 24 SKS</p>
                        </div>
                    </div>

                    <!-- Pencarian Mata Kuliah -->
                    <div class="relative">
                        <div class="relative">
                            <input type="text"
                                   id="searchMataKuliah"
                                   placeholder="Cari Mata Kuliah"
                                   class="p-3 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                   autocomplete="off">
                            <button class="absolute top-3 right-3">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Dropdown hasil pencarian -->
                        <div id="searchResults" class="hidden absolute z-10 mt-1 w-full bg-white rounded-lg shadow-lg">
                            <div class="overflow-y-auto p-2 space-y-2 max-h-60">
                                @if($mataKuliah && $mataKuliah->count() > 0)
                                    @foreach($mataKuliah as $mk)
                                    <div class="p-3 rounded-lg cursor-pointer hover:bg-gray-50 mata-kuliah-item"
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
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-semibold">List Mata Kuliah</h2>
                        </div>
                        <div class="p-4">
                            <div class="space-y-3" id="selectedMataKuliah">
                                <!-- Mata kuliah yang dipilih akan ditampilkan di sini -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Jadwal -->
                <div class="w-2/3 bg-white rounded-lg shadow">
                    <div class="grid grid-cols-6 border-b">
                        <div class="p-4 font-semibold">Jam</div>
                        <div class="p-4 font-semibold">Senin</div>
                        <div class="p-4 font-semibold">Selasa</div>
                        <div class="p-4 font-semibold">Rabu</div>
                        <div class="p-4 font-semibold">Kamis</div>
                        <div class="p-4 font-semibold">Jumat</div>
                    </div>

                    <div class="grid relative grid-cols-6">
                        <!-- Kolom waktu -->
                        <div class="border-r">
                            <div class="border-b h-[100px] px-4 py-2 text-sm">07:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">09:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">11:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">13:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">15:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">17:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">19:00</div>
                        </div>

                        <!-- Kolom hari -->
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                            <div class="relative min-h-full border-r" id="jadwal-{{ strtolower($hari) }}">
                                <!-- Tampilkan jadwal yang sudah ada -->
                                @foreach($jadwal as $j)
                                    @if($j->hari === $hari)
                                        <div class="overflow-hidden absolute p-2 w-full bg-blue-100 rounded-md border border-blue-200 jadwal-item"
                                             style="top: {{ (strtotime($j->waktu->waktu_mulai) - strtotime('07:00')) / 3600 * 100 }}px;
                                                    height: {{ (strtotime($j->waktu->waktu_selesai) - strtotime($j->waktu->waktu_mulai)) / 3600 * 100 }}px;"
                                             data-kode="{{ $j->kode_mk }}">
                                            <p class="text-sm font-medium text-blue-800">{{ $j->mataKuliah->nama }}</p>
                                            <p class="text-xs text-blue-600">{{ $j->waktu->waktu_mulai }} - {{ $j->waktu->waktu_selesai }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchMataKuliah');
    const searchResults = document.getElementById('searchResults');
    const mataKuliahItems = document.querySelectorAll('.mata-kuliah-item');
    const selectedMataKuliah = document.getElementById('selectedMataKuliah');
    const selectedItems = new Set(); // Untuk menyimpan kode MK yang sudah dipilih

    // Fungsi untuk memperbarui tampilan item mata kuliah
    function updateMataKuliahItemsAppearance() {
        mataKuliahItems.forEach(item => {
            const kode = item.getAttribute('data-kode');
            if (selectedItems.has(kode)) {
                item.classList.add('opacity-50', 'cursor-not-allowed', 'bg-gray-100');
                item.classList.remove('hover:bg-gray-50');
            } else {
                item.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-gray-100');
                item.classList.add('hover:bg-gray-50');
            }
        });
    }

    // Tampilkan dropdown saat input difokuskan
    searchInput.addEventListener('focus', () => {
        searchResults.classList.remove('hidden');
        updateMataKuliahItemsAppearance(); // Update tampilan saat dropdown dibuka
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


    // Data jadwal dari controller
    const jadwalData = {!! json_encode($jadwal->map(function($j) {
        return [
            'kode_mk' => $j->kode_mk,
            'nama_mk' => $j->mataKuliah->nama,
            'hari' => $j->hari,
            'waktu_mulai' => $j->waktu->waktu_mulai,
            'waktu_selesai' => $j->waktu->waktu_selesai,
        ];
    })) !!};

    console.log('Jadwal Data:', jadwalData);

    // Fungsi untuk mendapatkan posisi vertikal berdasarkan waktu
    function getVerticalPosition(waktu) {
        const baseTime = 7; // Jam mulai (07:00)
        const hour = parseInt(waktu.split(':')[0]);
        const minute = parseInt(waktu.split(':')[1]);
        return ((hour - baseTime) * 100) + ((minute / 60) * 100); // 100px adalah tinggi satu slot waktu
    }

    // Fungsi untuk mendapatkan durasi dalam pixel
    function getDuration(waktuMulai, waktuSelesai) {
        const mulai = new Date(`2024-01-01 ${waktuMulai}`);
        const selesai = new Date(`2024-01-01 ${waktuSelesai}`);
        const durasiJam = (selesai - mulai) / (1000 * 60 * 60);
        return durasiJam * 100; // 100px per jam
    }

    // Fungsi untuk menampilkan jadwal di grid
    function displayJadwal(kode_mk) {
        // Hapus jadwal yang sudah ada untuk mata kuliah ini
        document.querySelectorAll(`.jadwal-item[data-kode="${kode_mk}"]`).forEach(el => el.remove());

        // Cari jadwal untuk mata kuliah yang dipilih
        const jadwalMK = jadwalData.filter(j => j.kode_mk === kode_mk);

        jadwalMK.forEach(jadwal => {
            const container = document.getElementById(`jadwal-${jadwal.hari.toLowerCase()}`);
            const top = getVerticalPosition(jadwal.waktu_mulai);
            const height = getDuration(jadwal.waktu_mulai, jadwal.waktu_selesai);

            const jadwalElement = document.createElement('div');
            jadwalElement.className = `jadwal-item absolute w-full bg-blue-100 border border-blue-200 rounded-md p-2 overflow-hidden`;
            jadwalElement.style.top = `${top}px`;
            jadwalElement.style.height = `${height}px`;
            jadwalElement.setAttribute('data-kode', kode_mk);

            jadwalElement.innerHTML = `
                <p class="text-sm font-medium text-blue-800">${jadwal.nama_mk}</p>
                <p class="text-xs text-blue-600">${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}</p>
            `;

            container.appendChild(jadwalElement);
        });
    }

    // Fungsi untuk menghapus jadwal dari grid
    function removeJadwal(kode_mk) {
        document.querySelectorAll(`.jadwal-item[data-kode="${kode_mk}"]`).forEach(el => el.remove());
    }

    // Update event listener untuk penambahan mata kuliah
    mataKuliahItems.forEach(item => {
        item.addEventListener('click', () => {
            const kode = item.getAttribute('data-kode');

            if (selectedItems.has(kode)) {
                return;
            }

            const nama = item.getAttribute('data-nama');
            const sks = item.getAttribute('data-sks');

            // Tambahkan ke Set
            selectedItems.add(kode);

            // Update tampilan item di dropdown
            updateMataKuliahItemsAppearance();

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

            // Tambahkan tampilan jadwal
            displayJadwal(kode);
        });
    });

    // Update fungsi deleteMataKuliah
    function deleteMataKuliah(kode) {
        const itemToDelete = selectedMataKuliah.querySelector(`[data-kode="${kode}"]`);
        if (itemToDelete) {
            selectedItems.delete(kode);
            itemToDelete.remove();
            updateMataKuliahItemsAppearance();
            removeJadwal(kode); // Hapus jadwal dari grid
        }
    }

    // Tambahkan CSS untuk jadwal
    const style = document.createElement('style');
    style.textContent = `
        .jadwal-item {
            left: 2px;
            right: 2px;
            transition: all 0.3s ease;
        }
        .jadwal-item:hover {
            transform: scale(1.02);
            z-index: 10;
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
