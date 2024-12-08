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
        <div class="container px-4 py-6 mx-auto overflow-auto" style="height: 100vh;width: 200vw;">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Buat IRS</h1>
                <h1 class="text-2xl font-bold text-gray-800">IRS (3sks)</h1>
            </div>

            <div class="flex gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-6 w-1/4"> <!-- Mengurangi lebar kolom informasi akademik -->
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
                                         data-sks="{{ $mk->sks }}"
                                         data-semester="{{ $mk->semester }}"
                                         data-sifat="{{ strtoupper($mk->sifat) }}">
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
                <div class="w-3/4 bg-white rounded-lg shadow"> <!-- Mengubah lebar kolom kanan -->
                    <div class="grid grid-cols-6 border-b">
                        <div class="p-4 font-semibold">Jam</div>
                        <div class="p-4 font-semibold col-span-5 grid grid-cols-5 gap-12"> <!-- Menambahkan gap untuk jarak yang lebih lebar -->
                            <div class="w-1/5">Senin</div>
                            <div class="w-1/5">Selasa</div>
                            <div class="w-1/5">Rabu</div>
                            <div class="w-1/5">Kamis</div>
                            <div class="w-1/5">Jumat</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-6">
                        <!-- Kolom waktu -->
                        <div class="border-r">
                            <div class="border-b h-[50px] px-4 py-2 text-sm">07:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">08:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">09:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">10:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">11:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">12:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">13:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">14:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">15:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">16:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">17:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">18:00</div>
                            <div class="border-b h-[50px] px-4 py-2 text-sm">19:00</div>
                        </div>

                        <!-- Kolom hari dengan grid col-span-5 -->
                        <div class="col-span-5 grid grid-cols-5">
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                                <div class="relative min-h-full border-r" id="jadwal-{{ strtolower($hari) }}">
                                    <!-- Grid jadwal akan diisi melalui JavaScript -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const searchInput = $('#searchMataKuliah');
    const searchResults = $('#searchResults');
    const selectedMataKuliah = $('#selectedMataKuliah');
    const selectedItems = new Set(); // Untuk menyimpan kode MK yang sudah dipilih
    const selectedJadwal = new Set(); // Untuk menyimpan kode_mk yang jadwalnya sudah dipilih

    // Data jadwal dari controller - Perbaikan disini
    window.jadwalData = {!! json_encode($jadwal) !!}; // Simpan ke window object
    const jadwalData = window.jadwalData; // Referensi lokal

    console.log('Jadwal Data:', jadwalData);

    // Fungsi untuk memperbarui tampilan item mata kuliah
    function updateMataKuliahItemsAppearance() {
        $('.mata-kuliah-item').each(function() {
            const kode = $(this).data('kode');
            if (selectedItems.has(kode)) {
                $(this).addClass('opacity-50 cursor-not-allowed bg-gray-100')
                      .removeClass('hover:bg-gray-50');
            } else {
                $(this).removeClass('opacity-50 cursor-not-allowed bg-gray-100')
                      .addClass('hover:bg-gray-50');
            }
        });
    }

    // Tampilkan dropdown saat input difokuskan
    searchInput.on('focus', function() {
        searchResults.removeClass('hidden');
        updateMataKuliahItemsAppearance();
    });

    // Sembunyikan dropdown saat klik di luar area pencarian
    $(document).on('click', function(e) {
        if (!searchInput.is(e.target) && !searchResults.is(e.target) && searchResults.has(e.target).length === 0) {
            searchResults.addClass('hidden');
        }
    });

    // Filter hasil pencarian saat mengetik
    searchInput.on('input', function() {
        const searchTerm = $(this).val().toLowerCase();

        $('.mata-kuliah-item').each(function() {
            const nama = $(this).data('nama').toLowerCase();
            const kode = $(this).data('kode').toLowerCase();

            if (nama.includes(searchTerm) || kode.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        if (searchTerm) {
            searchResults.removeClass('hidden');
        }
    });

    // Load list mata kuliah saat halaman dimuat
    loadSavedMataKuliah();

    function loadSavedMataKuliah() {
        $.get('{{ route("list-mk-mhs.get") }}', function(response) {
            if (response.success) {
                response.data.forEach(item => {
                    const mk = item.mata_kuliah;
                    selectedItems.add(mk.kode_mk);
                    
                    // Cek jadwal yang sudah dipilih
                    const selectedJadwalForMK = jadwalData.find(j => 
                        j.kode_mk === mk.kode_mk && j.is_selected
                    );
                    if (selectedJadwalForMK) {
                        selectedJadwal.add(mk.kode_mk);
                    }
                    
                    const newItem = createMataKuliahItem(
                        mk.kode_mk,
                        mk.nama,
                        mk.sks,
                        mk.semester,
                        mk.sifat
                    );
                    selectedMataKuliah.append(newItem);
                });
                updateMataKuliahItemsAppearance();
                updateJadwalDisplay();
            }
        });
    }

    // Update event handler untuk memilih mata kuliah
    $('.mata-kuliah-item').on('click', function() {
        const kode = $(this).data('kode');
        if (selectedItems.has(kode)) return;

        // Simpan ke database
        $.ajax({
            url: '{{ route("list-mk-mhs.store") }}',
            type: 'POST',
            data: {
                kode_mk: kode,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    selectedItems.add(kode);
                    const newItem = createMataKuliahItem(
                        kode,
                        $(this).data('nama'),
                        $(this).data('sks'),
                        $(this).data('semester'),
                        $(this).data('sifat')
                    );
                    selectedMataKuliah.append(newItem);
                    updateMataKuliahItemsAppearance();
                    updateJadwalDisplay();
                }
            }.bind(this),
            error: function(xhr) {
                alert('Gagal menambahkan mata kuliah: ' + xhr.responseJSON.message);
            }
        });

        searchInput.val('');
        searchResults.addClass('hidden');
    });

    // Update event handler untuk menghapus mata kuliah
    $(document).on('click', '.delete-mk', function() {
        const item = $(this).closest('[data-kode]');
        const kode = item.data('kode');

        // Hapus dari database
        $.ajax({
            url: `{{ url('list-mk-mhs/delete') }}/${kode}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    selectedJadwal.delete(kode);
                    selectedItems.delete(kode);
                    item.remove();
                    updateMataKuliahItemsAppearance();
                    updateJadwalDisplay();
                }
            },
            error: function(xhr) {
                alert('Gagal menghapus mata kuliah: ' + xhr.responseJSON.message);
            }
        });
    });

    // Fungsi helper untuk membuat item mata kuliah
    function createMataKuliahItem(kode, nama, sks, semester, sifat) {
        return $(`
            <div class="flex justify-between items-center p-3 rounded-lg hover:bg-gray-50" data-kode="${kode}">
                <div>
                    <h3 class="font-medium">${nama}</h3>
                    <p class="text-sm text-gray-600">${kode} (${sks} SKS) SMT ${semester} ${sifat}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="p-2 toggle-jadwal" title="Sembunyikan/Tampilkan Jadwal">
                        <svg class="w-5 h-5 text-blue-500 hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <button class="p-2 delete-mk">
                        <svg class="w-5 h-5 text-red-400 hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        `);
    }

    // Event handler untuk toggle jadwal
    $(document).on('click', '.toggle-jadwal', function() {
        const item = $(this).closest('[data-kode]');
        const kode = item.data('kode');
        const jadwalItems = $(`.jadwal-item[data-kode="${kode}"]`);

        // Toggle icon mata
        const svg = $(this).find('svg');
        if (jadwalItems.is(':visible')) {
            jadwalItems.fadeOut(200);
            svg.html(`
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `);
        } else {
            jadwalItems.fadeIn(200);
            svg.html(`
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `);
        }
    });

    // Update event handler untuk memilih jadwal
    $(document).on('click', '.jadwal-item', function() {
        const jadwalItem = $(this);
        const kode = jadwalItem.data('kode');
        const jadwalId = parseInt(jadwalItem.data('jadwal-id'));
        
        // Cek apakah jadwal ini sudah dipilih
        if (jadwalItem.hasClass('selected')) {
            return;
        }

        // Cek apakah sudah ada jadwal yang dipilih untuk mata kuliah ini
        if (selectedJadwal.has(kode)) {
            alert('Anda sudah memilih jadwal untuk mata kuliah ini');
            return;
        }

        // Cari data jadwal yang sesuai
        const jadwalInfo = jadwalData.find(j => j.id === jadwalId);
        if (!jadwalInfo) {
            console.error('Jadwal tidak ditemukan:', jadwalId);
            alert('Data jadwal tidak ditemukan');
            return;
        }

        // Proses pemilihan jadwal
        $.ajax({
            url: '{{ route("mahasiswa.store_pengambilan_irs") }}',
            type: 'POST',
            data: {
                jadwal_id: jadwalId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Update status jadwal yang dipilih
                    jadwalInfo.is_selected = true;
                    jadwalInfo.mk_selected = true;
                    selectedJadwal.add(kode);

                    // Update status bertabrakan untuk jadwal lain
                    jadwalData.forEach(j => {
                        if (j.id !== jadwalId && j.hari === jadwalInfo.hari) {
                            const jMulai = new Date(`2024-01-01 ${j.waktu_mulai}`).getTime();
                            const jSelesai = new Date(`2024-01-01 ${j.waktu_selesai}`).getTime();
                            const selectedMulai = new Date(`2024-01-01 ${jadwalInfo.waktu_mulai}`).getTime();
                            const selectedSelesai = new Date(`2024-01-01 ${jadwalInfo.waktu_selesai}`).getTime();

                            if (
                                (jMulai >= selectedMulai && jMulai < selectedSelesai) ||
                                (jSelesai > selectedMulai && jSelesai <= selectedSelesai) ||
                                (jMulai <= selectedMulai && jSelesai >= selectedSelesai)
                            ) {
                                j.is_bertabrakan = true;
                            }
                        }
                    });

                    // Update mk_selected untuk jadwal lain dengan kode_mk yang sama
                    jadwalData.forEach(j => {
                        if (j.kode_mk === kode && j.id !== jadwalId) {
                            j.mk_selected = true;
                        }
                    });
                    
                    // Update tampilan untuk semua mata kuliah yang sudah dipilih
                    selectedItems.forEach(selectedKode => {
                        const jadwalMK = jadwalData.filter(j => j.kode_mk === selectedKode);
                        jadwalMK.forEach(jadwal => {
                            // Update status bertabrakan untuk jadwal yang sudah dipilih
                            if (jadwal.hari === jadwalInfo.hari && !jadwal.is_selected) {
                                const jMulai = new Date(`2024-01-01 ${jadwal.waktu_mulai}`).getTime();
                                const jSelesai = new Date(`2024-01-01 ${jadwal.waktu_selesai}`).getTime();
                                const selectedMulai = new Date(`2024-01-01 ${jadwalInfo.waktu_mulai}`).getTime();
                                const selectedSelesai = new Date(`2024-01-01 ${jadwalInfo.waktu_selesai}`).getTime();

                                if (
                                    (jMulai >= selectedMulai && jMulai < selectedSelesai) ||
                                    (jSelesai > selectedMulai && jSelesai <= selectedSelesai) ||
                                    (jMulai <= selectedMulai && jSelesai >= selectedSelesai)
                                ) {
                                    jadwal.is_bertabrakan = true;
                                }
                            }
                        });
                    });
                    
                    // Update tampilan jadwal
                    updateJadwalDisplay();
                    
                    // Update kuota terisi
                    jadwalInfo.kuota_terisi++;
                    
                    alert('Jadwal berhasil dipilih');
                }
            },
            error: function(xhr) {
                const message = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                alert('Gagal memilih jadwal: ' + message);
            }
        });
    });

    // Update fungsi updateJadwalDisplay
    function updateJadwalDisplay() {
        $('.jadwal-item').remove();

        const overlappingSlots = {};

        selectedItems.forEach(kode => {
            const listItem = $(`[data-kode="${kode}"]`);
            const isHidden = listItem.find('.toggle-jadwal svg path').length > 2;
            const jadwalMK = jadwalData.filter(j => j.kode_mk === kode);

            jadwalMK.forEach(jadwal => {
                const container = $(`#jadwal-${jadwal.hari.toLowerCase()}`);
                if (container.length) {
                    const timeSlotKey = `${jadwal.hari}-${jadwal.waktu_mulai}`;
                    
                    if (!overlappingSlots[timeSlotKey]) {
                        overlappingSlots[timeSlotKey] = [];
                    }
                    
                    overlappingSlots[timeSlotKey].push({
                        jadwal,
                        kode,
                        isHidden,
                        isSelected: jadwal.is_selected
                    });
                }
            });
        });

        Object.entries(overlappingSlots).forEach(([timeSlotKey, jadwalItems]) => {
            const [hari, waktuMulai] = timeSlotKey.split('-');
            const container = $(`#jadwal-${hari.toLowerCase()}`);
            const width = 100 / jadwalItems.length;

            jadwalItems.forEach((item, index) => {
                const { jadwal, kode, isHidden, isSelected } = item;
                const top = getVerticalPosition(jadwal.waktu_mulai);
                const height = getDuration(jadwal.waktu_mulai, jadwal.waktu_selesai);
                const left = width * index;

                // Tentukan kelas dan status berdasarkan kondisi jadwal
                let statusClass = 'bg-blue-100 hover:bg-blue-200';
                let disabledStatus = '';
                let cursorClass = 'cursor-pointer';
                let borderClass = 'border-gray-200';

                if (isSelected) {
                    statusClass = 'bg-green-100';
                    cursorClass = 'cursor-default';
                    borderClass = 'border-green-500';
                } else if (jadwal.mk_selected) {
                    statusClass = 'bg-gray-100';
                    disabledStatus = 'disabled';
                    cursorClass = 'cursor-not-allowed';
                } else if (jadwal.is_bertabrakan) {
                    statusClass = 'bg-red-100';
                    disabledStatus = 'disabled';
                    cursorClass = 'cursor-not-allowed';
                    borderClass = 'border-red-300';
                } else if (jadwal.kuota_terisi >= jadwal.kuota) {
                    statusClass = 'bg-red-50';
                    disabledStatus = 'disabled';
                    cursorClass = 'cursor-not-allowed';
                }

                const jadwalElement = $(`
                    <div class="overflow-hidden absolute p-2 rounded-md border jadwal-item ${statusClass} ${cursorClass} ${borderClass}"
                         style="top: ${top}px; height: ${height}px; left: ${left}%; width: ${width}%; ${isHidden ? 'display: none;' : ''}"
                         data-kode="${kode}"
                         data-jadwal-id="${jadwal.id}"
                         ${disabledStatus}>
                        <p class="text-sm font-medium text-gray-800 truncate">${jadwal.nama_mk}</p>
                        <p class="text-xs text-gray-600">${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}</p>
                        <p class="text-xs text-gray-600">Kelas ${jadwal.kelas} (${jadwal.ruang})</p>
                        <p class="text-xs ${jadwal.kuota_terisi >= jadwal.kuota ? 'text-red-600 font-semibold' : 'text-gray-600'}">
                            Kuota: ${jadwal.kuota_terisi}/${jadwal.kuota}
                        </p>
                    </div>
                `);

                if (disabledStatus) {
                    jadwalElement.css('pointer-events', 'none');
                }

                container.append(jadwalElement);
            });
        });
    }

    // Fungsi helper untuk posisi dan durasi
    function getVerticalPosition(waktu) {
        const baseTime = 7;
        const [hour, minute] = waktu.split(':').map(Number);
        return ((hour - baseTime) * 50) + ((minute / 60) * 50);
    }

    function getDuration(waktuMulai, waktuSelesai) {
        const mulai = new Date(`2024-01-01 ${waktuMulai}`);
        const selesai = new Date(`2024-01-01 ${waktuSelesai}`);
        const durasiJam = (selesai - mulai) / (1000 * 60 * 60);
        return durasiJam * 50;
    }

    // Tambahkan CSS untuk jadwal yang dipilih
    $('<style>')
        .text(`
            .jadwal-item {
                left: 2px;
                right: 2px;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            .jadwal-item:hover {
                transform: scale(1.02);
                z-index: 10;
            }
            .jadwal-item.selected {
                background-color: #DEF7EC !important;
                border-color: #0F766E;
            }
        `)
        .appendTo('head');
});
</script>
@endpush
