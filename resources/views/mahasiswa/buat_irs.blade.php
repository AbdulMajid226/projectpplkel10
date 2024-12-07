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

                        <!-- Kolom hari -->
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                            <div class="relative min-h-full border-r" id="jadwal-{{ strtolower($hari) }}">
                                <!-- Grid jadwal akan diisi melalui JavaScript -->
                            </div>
                        @endforeach
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
    const selectedJadwal = new Set(); // Tambahkan Set untuk menyimpan kode_mk yang jadwalnya sudah dipilih

    // Data jadwal dari controller
    const jadwalData = {!! json_encode($jadwal) !!}; // Data jadwal sudah dalam format yang benar

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

    // Event handler untuk memilih mata kuliah
    $('.mata-kuliah-item').on('click', function() {
        const kode = $(this).data('kode');
        const nama = $(this).data('nama');
        const sks = $(this).data('sks');
        const semester = $(this).data('semester');
        const sifat = $(this).data('sifat');

        if (selectedItems.has(kode)) {
            return;
        }

        // Tambahkan ke Set
        selectedItems.add(kode);
        updateMataKuliahItemsAppearance();

        // Tambahkan ke list mata kuliah yang dipilih
        const newItem = $(`
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

        selectedMataKuliah.append(newItem);

        // Update tampilan jadwal
        updateJadwalDisplay();

        // Bersihkan input dan sembunyikan dropdown
        searchInput.val('');
        searchResults.addClass('hidden');
    });

    // Event handler untuk menghapus mata kuliah
    $(document).on('click', '.delete-mk', function() {
        const item = $(this).closest('[data-kode]');
        const kode = item.data('kode');

        // Hapus dari Set jadwal yang dipilih
        selectedJadwal.delete(kode);
        selectedItems.delete(kode);

        item.remove();
        updateMataKuliahItemsAppearance();
        updateJadwalDisplay();
    });

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
        const jadwalId = jadwalItem.data('jadwal-id');

        // Cek apakah jadwal ini sudah dipilih
        if (jadwalItem.hasClass('selected')) {
            return; // Jika sudah dipilih, abaikan klik
        }

        // Cek apakah sudah ada jadwal yang dipilih untuk mata kuliah ini
        if (selectedJadwal.has(kode)) {
            alert('Anda sudah memilih jadwal untuk mata kuliah ini');
            return;
        }

        // Hapus seleksi dari jadwal lain untuk mata kuliah yang sama
        $(`.jadwal-item[data-kode="${kode}"]`).removeClass('selected bg-green-100').addClass('bg-blue-100');

        // Pilih jadwal ini
        jadwalItem.removeClass('bg-blue-100').addClass('selected bg-green-100');

        // Kirim data ke server
        $.ajax({
            url: '{{ route("mahasiswa.store_pengambilan_irs") }}',
            type: 'POST',
            data: {
                jadwal_id: jadwalId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Tambahkan kode_mk ke Set jadwal yang sudah dipilih
                    selectedJadwal.add(kode);

                    // Nonaktifkan jadwal lain untuk mata kuliah yang sama
                    $(`.jadwal-item[data-kode="${kode}"]`).not(jadwalItem)
                        .addClass('opacity-50 cursor-not-allowed')
                        .css('pointer-events', 'none');

                    // Tampilkan notifikasi sukses
                    alert('Jadwal berhasil dipilih');
                } else {
                    // Jika gagal, kembalikan tampilan seperti semula
                    jadwalItem.removeClass('selected bg-green-100').addClass('bg-blue-100');
                }
            },
            error: function(xhr) {
                // Jika terjadi error, kembalikan tampilan seperti semula
                jadwalItem.removeClass('selected bg-green-100').addClass('bg-blue-100');
                alert('Gagal memilih jadwal: ' + xhr.responseJSON.message);
            }
        });
    });

    // Update fungsi updateJadwalDisplay untuk menangani jadwal yang sudah dipilih
    function updateJadwalDisplay() {
        $('.jadwal-item').remove();

        selectedItems.forEach(kode => {
            const listItem = $(`[data-kode="${kode}"]`);
            const isHidden = listItem.find('.toggle-jadwal svg path').length > 2;
            const jadwalMK = jadwalData.filter(j => j.kode_mk === kode);

            jadwalMK.forEach(jadwal => {
                const container = $(`#jadwal-${jadwal.hari.toLowerCase()}`);
                if (container.length) {
                    const top = getVerticalPosition(jadwal.waktu_mulai);
                    const height = getDuration(jadwal.waktu_mulai, jadwal.waktu_selesai);
                    const isSelected = selectedJadwal.has(kode);

                    const jadwalElement = $(`
                        <div class="overflow-hidden absolute p-2 w-full bg-blue-100 rounded-md border border-blue-200 jadwal-item cursor-pointer hover:bg-blue-200
                            ${isSelected ? 'selected bg-green-100' : ''}
                            ${selectedJadwal.has(kode) && !isSelected ? 'opacity-50 cursor-not-allowed' : ''}"
                             style="top: ${top}px; height: ${height}px; ${isHidden ? 'display: none;' : ''}"
                             data-kode="${kode}"
                             data-jadwal-id="${jadwal.id}">
                            <p class="text-sm font-medium text-blue-800">${jadwal.nama_mk}</p>
                            <p class="text-xs text-blue-600">${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}</p>
                            <p class="text-xs text-blue-600">Kelas ${jadwal.kelas} (${jadwal.ruang})</p>
                        </div>
                    `);

                    if (selectedJadwal.has(kode) && !isSelected) {
                        jadwalElement.css('pointer-events', 'none');
                    }

                    container.append(jadwalElement);
                }
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
