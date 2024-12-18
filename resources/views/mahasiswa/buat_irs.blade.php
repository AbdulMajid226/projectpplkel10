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
    @elseif($irs && $irs->status_persetujuan === 'Sudah Disetujui')
        <div class="flex flex-col justify-center items-center py-6 min-h-screen bg-gray-100">
            <div class="p-8 max-w-lg text-center bg-white rounded-lg shadow-md">
                <svg class="mx-auto w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="mt-4 text-xl font-semibold text-gray-800">IRS Sudah Disetujui</h2>
                <p class="mt-4 text-gray-600">
                    IRS Anda untuk semester ini telah disetujui oleh dosen wali.
                    Jika Anda ingin melakukan perubahan atau pembatalan IRS,
                    silakan hubungi dosen wali Anda.
                </p>
                <div class="mt-6 space-y-3">
                    <a href="{{ route('irs_mhs') }}"
                       class="inline-block px-4 py-2 w-full text-white bg-blue-500 rounded-lg transition-colors hover:bg-blue-600">
                        Lihat IRS Saya
                    </a>
                    <p class="text-sm text-gray-500">
                        Dosen Wali: {{ Auth::user()->mahasiswa->pembimbingAkademik->nama }}
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="container overflow-auto px-4 py-6 mx-auto" style="height: 100vh;width: 200vw;">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Buat IRS</h1>
                <h1 class="text-2xl font-bold text-gray-800">IRS (3sks)</h1>
            </div>

            <!-- Tabel IRS yang sudah dipilih -->
            <div class="overflow-hidden mb-6 bg-white rounded-lg shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kode Mata Kuliah</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Mata Kuliah</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kelas</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">SKS</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="selectedIRSTable">
                            <!-- Data akan diisi melalui JavaScript -->
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-sm font-medium text-right text-gray-500">Total SKS:</td>
                                <td class="px-6 py-3 text-sm font-medium text-left text-gray-900" id="totalSKS">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Notifikasi -->
            <div id="notification" class="fixed top-4 right-4 z-50 transition-transform duration-300 transform translate-x-full">
                <div class="p-4 max-w-sm bg-white rounded-lg border-l-4 shadow-lg">
                    <div class="flex items-center">
                        <div id="notificationIcon" class="flex-shrink-0">
                            <!-- Icon akan diisi melalui JavaScript -->
                        </div>
                        <div class="ml-3">
                            <p id="notificationMessage" class="text-sm font-medium"></p>
                        </div>
                        <div class="flex flex-shrink-0 ml-4">
                            <button onclick="hideNotification()" class="inline-flex text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
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
                    <div class="grid sticky -top-6 z-20 grid-cols-6 bg-white border-b shadow-sm">
                        <div class="p-4 font-semibold border-r border-gray-300">Jam</div>
                        <div class="grid grid-cols-5 col-span-5 p-4 font-semibold">
                            <div class="w-full text-center border-r-2 border-gray-300">Senin</div>
                            <div class="w-full text-center border-r-2 border-gray-300">Selasa</div>
                            <div class="w-full text-center border-r-2 border-gray-300">Rabu</div>
                            <div class="w-full text-center border-r-2 border-gray-300">Kamis</div>
                            <div class="w-full text-center">Jumat</div>
                        </div>
                    </div>

                    <div class="grid relative grid-cols-6">
                        <!-- Kolom waktu -->
                        <div class="border-r sticky left-0 top-[42px] bg-white z-10">
                            <div class="border-b h-[100px] px-4 py-2 text-sm">07:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">08:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">09:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">10:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">11:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">12:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">13:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">14:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">15:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">16:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">17:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">18:00</div>
                            <div class="border-b h-[100px] px-4 py-2 text-sm">19:00</div>
                        </div>

                        <!-- Kolom hari dengan grid col-span-5 -->
                        <div class="grid grid-cols-5 col-span-5">
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                                <div class="relative min-h-full border-r border-gray-300 {{ $loop->last ? '' : 'border-r-2' }}"
                                     id="jadwal-{{ strtolower($hari) }}">
                                    <!-- Garis horizontal per jam -->
                                    @for ($i = 0; $i < 13; $i++)
                                        <div class="absolute w-full border-b border-gray-200"
                                             style="top: {{ $i * 100 }}px; height: 1px;">
                                        </div>
                                    @endfor
                                    <!-- Grid jadwal akan diisi melalui JavaScript -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Konfirmasi -->
    <div id="konfirmasiModal" class="hidden overflow-y-auto fixed inset-0 z-50">
        <div class="flex justify-center items-center px-4 min-h-screen">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Modal Content -->
            <div class="relative p-6 w-full max-w-md bg-white rounded-lg shadow-xl">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Pemilihan Jadwal</h3>
                </div>

                <div class="mb-4 space-y-3">
                    <p class="text-gray-600">Apakah Anda yakin ingin memilih jadwal berikut:</p>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="font-medium text-gray-900" id="modalMataKuliah"></p>
                        <div class="mt-2 space-y-1 text-sm text-gray-600">
                            <p id="modalKode"></p>
                            <p id="modalKelas"></p>
                            <p id="modalWaktu"></p>
                            <p id="modalRuang"></p>
                            <p id="modalKuota"></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelJadwal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <button type="button" id="confirmJadwal"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Pilih Jadwal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="konfirmasiHapusModal" class="hidden overflow-y-auto fixed inset-0 z-50">
        <div class="flex justify-center items-center px-4 min-h-screen">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Modal Content -->
            <div class="relative p-6 w-full max-w-md bg-white rounded-lg shadow-xl">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus Jadwal</h3>
                </div>

                <div class="mb-4 space-y-3">
                    <p class="text-gray-600">Apakah Anda yakin ingin menghapus jadwal berikut:</p>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="font-medium text-gray-900" id="hapusModalMataKuliah"></p>
                        <div class="mt-2 space-y-1 text-sm text-gray-600">
                            <p id="hapusModalKode"></p>
                            <p id="hapusModalKelas"></p>
                            <p id="hapusModalWaktu"></p>
                            <p id="hapusModalRuang"></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelHapus"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <button type="button" id="confirmHapus"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Hapus Jadwal
                    </button>
                </div>
            </div>
        </div>
    </div>
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

    // Tambahkan variabel untuk menyimpan data jadwal yang akan dihapus
    let deleteJadwalInfo = null;

    // Tambahkan fungsi untuk generate warna di bagian awal script
    function generateColorFromString(str) {
        const colors = [
            { bg: 'bg-blue-200', border: 'border-blue-400', hover: 'hover:bg-blue-300' },
            { bg: 'bg-pink-200', border: 'border-pink-400', hover: 'hover:bg-pink-300' },
            { bg: 'bg-purple-200', border: 'border-purple-400', hover: 'hover:bg-purple-300' },
            { bg: 'bg-yellow-200', border: 'border-yellow-400', hover: 'hover:bg-yellow-300' },
            { bg: 'bg-indigo-200', border: 'border-indigo-400', hover: 'hover:bg-indigo-300' },
            { bg: 'bg-orange-200', border: 'border-orange-400', hover: 'hover:bg-orange-300' },
            { bg: 'bg-teal-200', border: 'border-teal-400', hover: 'hover:bg-teal-300' },
            { bg: 'bg-lime-200', border: 'border-lime-400', hover: 'hover:bg-lime-300' },
        ];

        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            hash = str.charCodeAt(i) + ((hash << 5) - hash);
        }

        return colors[Math.abs(hash) % colors.length];
    }

    // Simpan warna untuk setiap mata kuliah
    const mkColors = new Map();

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

    // Update tabel IRS setelah data dimuat
    updateIRSTable();

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
        if ($(this).prop('disabled')) {
            return;
        }

        const item = $(this).closest('[data-kode]');
        const kode = item.data('kode');

        // Cek apakah mata kuliah ini sudah memiliki jadwal yang dipilih
        if (selectedJadwal.has(kode)) {
            alert('Tidak dapat menghapus mata kuliah yang sudah memiliki jadwal terpilih');
            return;
        }

        // Hapus dari database
        $.ajax({
            url: `{{ url('list-mk-mhs/delete') }}/${kode}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
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
        const hasSelectedJadwal = selectedJadwal.has(kode);

        if (!mkColors.has(kode)) {
            mkColors.set(kode, generateColorFromString(kode));
        }
        const color = mkColors.get(kode);

        // Tentukan kelas CSS berdasarkan status
        const itemClass = hasSelectedJadwal ?
            'bg-green-200 border-green-300' :
            `${color.bg} ${color.border}`;

        const deleteButtonClass = hasSelectedJadwal ?
            'text-gray-400 cursor-not-allowed' :
            'text-red-400 hover:text-red-600 cursor-pointer';

        return $(`
            <div class="flex justify-between items-center p-3 rounded-lg border ${itemClass} transition-all duration-300 ease-in-out" data-kode="${kode}">
                <div>
                    <h3 class="font-medium text-gray-900">${nama}</h3>
                    <p class="text-sm text-gray-700">${kode} (${sks} SKS) SMT ${semester} ${sifat}</p>
                    ${hasSelectedJadwal ? '<p class="text-xs font-medium text-green-700">Jadwal sudah dipilih</p>' : ''}
                </div>
                <div class="flex items-center space-x-2">
                    <button class="p-2 toggle-jadwal" title="Sembunyikan/Tampilkan Jadwal">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <button class="p-2 delete-mk" ${hasSelectedJadwal ? 'disabled' : ''}>
                        <svg class="w-5 h-5 ${deleteButtonClass}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    // Tambahkan variabel untuk menyimpan data jadwal yang akan dipilih
    let selectedJadwalInfo = null;

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
            showNotification('Anda sudah memilih jadwal untuk mata kuliah ini', 'error');
            return;
        }

        // Cari data jadwal yang sesuai
        const jadwalInfo = jadwalData.find(j => j.id === jadwalId);
        if (!jadwalInfo) {
            console.error('Jadwal tidak ditemukan:', jadwalId);
            showNotification('Data jadwal tidak ditemukan', 'error');
            return;
        }

        // Hitung total SKS saat ini
        const currentSKS = calculateTotalSKS();
        const newSKS = currentSKS + (jadwalInfo.sks || 3);

        // Cek apakah melebihi batas maksimum SKS (24)
        if (newSKS > 24) {
            showNotification('Total SKS tidak boleh melebihi 24 SKS', 'error');
            return;
        }

        // Tampilkan modal konfirmasi
        selectedJadwalInfo = jadwalInfo;
        $('#modalMataKuliah').text(jadwalInfo.nama_mk);
        $('#modalKode').text(`Kode MK: ${jadwalInfo.kode_mk}`);
        $('#modalKelas').text(`Kelas: ${jadwalInfo.kelas}`);
        $('#modalWaktu').text(`Waktu: ${jadwalInfo.hari}, ${jadwalInfo.waktu_mulai} - ${jadwalInfo.waktu_selesai}`);
        $('#modalRuang').text(`Ruang: ${jadwalInfo.ruang}`);
        $('#modalKuota').text(`Kuota: ${jadwalInfo.kuota_terisi}/${jadwalInfo.kuota}`);
        $('#konfirmasiModal').removeClass('hidden');
    });

    // Tambahkan fungsi untuk menghitung total SKS
    function calculateTotalSKS() {
        let totalSKS = 0;
        const selectedJadwals = jadwalData.filter(j => j.is_selected);

        selectedJadwals.forEach(jadwal => {
            totalSKS += jadwal.sks || 3;
        });

        return totalSKS;
    }

    // Event handler untuk tombol batal
    $('#cancelJadwal').on('click', function() {
        $('#konfirmasiModal').addClass('hidden');
        selectedJadwalInfo = null;
    });

    // Event handler untuk tombol konfirmasi
    $('#confirmJadwal').on('click', function() {
        if (!selectedJadwalInfo) return;

        // Proses pemilihan jadwal
        $.ajax({
            url: '{{ route("mahasiswa.store_pengambilan_irs") }}',
            type: 'POST',
            data: {
                jadwal_id: selectedJadwalInfo.id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Update status jadwal yang dipilih
                    selectedJadwalInfo.is_selected = true;
                    selectedJadwalInfo.mk_selected = true;
                    selectedJadwal.add(selectedJadwalInfo.kode_mk);

                    // Update status bertabrakan untuk jadwal lain
                    jadwalData.forEach(j => {
                        if (j.id !== selectedJadwalInfo.id && j.hari === selectedJadwalInfo.hari) {
                            const jMulai = new Date(`2024-01-01 ${j.waktu_mulai}`).getTime();
                            const jSelesai = new Date(`2024-01-01 ${j.waktu_selesai}`).getTime();
                            const selectedMulai = new Date(`2024-01-01 ${selectedJadwalInfo.waktu_mulai}`).getTime();
                            const selectedSelesai = new Date(`2024-01-01 ${selectedJadwalInfo.waktu_selesai}`).getTime();

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
                        if (j.kode_mk === selectedJadwalInfo.kode_mk && j.id !== selectedJadwalInfo.id) {
                            j.mk_selected = true;
                        }
                    });

                    // Update tampilan untuk semua mata kuliah yang sudah dipilih
                    selectedItems.forEach(selectedKode => {
                        const jadwalMK = jadwalData.filter(j => j.kode_mk === selectedKode);
                        jadwalMK.forEach(jadwal => {
                            // Update status bertabrakan untuk jadwal yang sudah dipilih
                            if (jadwal.hari === selectedJadwalInfo.hari && !jadwal.is_selected) {
                                const jMulai = new Date(`2024-01-01 ${jadwal.waktu_mulai}`).getTime();
                                const jSelesai = new Date(`2024-01-01 ${jadwal.waktu_selesai}`).getTime();
                                const selectedMulai = new Date(`2024-01-01 ${selectedJadwalInfo.waktu_mulai}`).getTime();
                                const selectedSelesai = new Date(`2024-01-01 ${selectedJadwalInfo.waktu_selesai}`).getTime();

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

                    // Update tampilan list mata kuliah
                    updateListMataKuliah();

                    // Update tabel IRS
                    updateIRSTable();

                    // Update kuota terisi
                    selectedJadwalInfo.kuota_terisi++;

                    // Sembunyikan modal
                    $('#konfirmasiModal').addClass('hidden');
                    selectedJadwalInfo = null;

                    showNotification('Jadwal berhasil dipilih');
                }
            },
            error: function(xhr) {
                const message = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                showNotification('Gagal memilih jadwal: ' + message, 'error');
                $('#konfirmasiModal').addClass('hidden');
                selectedJadwalInfo = null;
            }
        });
    });

    // Tutup modal saat klik backdrop
    $('#konfirmasiModal').on('click', function(e) {
        if (e.target === this) {
            $(this).addClass('hidden');
            selectedJadwalInfo = null;
        }
    });

    // Tambahkan fungsi untuk memperbarui tampilan list mata kuliah
    function updateListMataKuliah() {
        // Kosongkan container list mata kuliah
        selectedMataKuliah.empty();

        // Ambil ulang data list mata kuliah dari server
        $.get('{{ route("list-mk-mhs.get") }}', function(response) {
            if (response.success) {
                response.data.forEach(item => {
                    const mk = item.mata_kuliah;
                    const newItem = createMataKuliahItem(
                        mk.kode_mk,
                        mk.nama,
                        mk.sks,
                        mk.semester,
                        mk.sifat
                    );
                    selectedMataKuliah.append(newItem);
                });
            }
        });
    }

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
            const width =100 / jadwalItems.length;

            jadwalItems.forEach((item, index) => {
                const { jadwal, kode, isHidden, isSelected } = item;
                const top = getVerticalPosition(jadwal.waktu_mulai);
                const height = getDuration(jadwal.waktu_mulai, jadwal.waktu_selesai);
                const left = width * index;

                // Tentukan kelas dan status berdasarkan kondisi jadwal
                let statusClass = `${mkColors.get(kode).bg} ${mkColors.get(kode).hover} shadow-sm`;
                let extraClasses = '';

                if (isSelected) {
                    statusClass = 'bg-green-300 shadow-md';
                } else if (jadwal.mk_selected) {
                    statusClass = 'bg-gray-200 shadow-sm';
                } else if (jadwal.is_bertabrakan) {
                    statusClass = 'bg-red-300 shadow-md';
                } else if (jadwal.kuota_terisi >= jadwal.kuota) {
                    statusClass = 'bg-gray-100 shadow-sm';
                }

                const jadwalElement = $(`
                    <div class="overflow-hidden absolute p-2 rounded-md border-2 jadwal-item
                         ${statusClass}
                         ${isSelected ? 'bg-green-300 border-green-500 border-2 ring-2 ring-green-500 ring-opacity-20' : ''}
                         ${jadwal.mk_selected ? 'opacity-50 bg-gray-200 border-gray-400 cursor-not-allowed' : ''}
                         ${jadwal.is_bertabrakan ? 'bg-red-300 border-red-500 border-2 ring-2 ring-red-500 ring-opacity-20 cursor-not-allowed' : ''}
                         ${jadwal.kuota_terisi >= jadwal.kuota ? 'bg-gray-100 border-gray-300 opacity-70 cursor-not-allowed' : ''}"
                         style="top: ${top}px; height: ${height}px; left: ${left}%; width: ${width}%; ${isHidden ? 'display: none;' : ''}"
                         data-kode="${kode}"
                         data-jadwal-id="${jadwal.id}">
                        <div class="flex flex-col justify-between h-full">
                            <div>
                                <p class="text-sm font-medium leading-tight text-gray-900 break-words" style="word-wrap: break-word; min-height: 2.5rem;">${jadwal.nama_mk}</p>
                                <p class="text-xs text-gray-700">${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}</p>
                                <p class="text-xs text-gray-700">Kelas ${jadwal.kelas} (${jadwal.ruang})</p>
                            </div>
                            <div class="mt-1">
                                <p class="text-xs ${jadwal.kuota_terisi >= jadwal.kuota ? 'text-red-600 font-semibold' : 'text-gray-700'}">
                                    Kuota: ${jadwal.kuota_terisi}/${jadwal.kuota}
                                </p>
                                ${jadwal.is_bertabrakan ? '<p class="text-xs font-medium text-red-600">Bentrok dengan jadwal lain</p>' : ''}
                                ${jadwal.is_selected ? '<p class="text-xs text-gray-500">Jadwal sudah dipilih</p>' : ''}
                            </div>
                        </div>
                    </div>
                `);

                container.append(jadwalElement);
            });
        });
    }

    // Fungsi helper untuk posisi dan durasi
    function getVerticalPosition(waktu) {
        const baseTime = 7;
        const [hour, minute] = waktu.split(':').map(Number);
        return ((hour - baseTime) * 100) + ((minute / 60) * 100);
    }

    function getDuration(waktuMulai, waktuSelesai) {
        const mulai = new Date(`2024-01-01 ${waktuMulai}`);
        const selesai = new Date(`2024-01-01 ${waktuSelesai}`);
        const durasiJam = (selesai - mulai) / (1000 * 60 * 60);
        return durasiJam * 100;
    }

    // Tambahkan fungsi untuk menangani notifikasi
    function showNotification(message, type = 'success') {
        const notification = $('#notification');
        const notificationMessage = $('#notificationMessage');
        const notificationIcon = $('#notificationIcon');

        // Set pesan
        notificationMessage.text(message);

        // Set icon dan warna berdasarkan tipe
        if (type === 'success') {
            notification.find('.border-l-4').removeClass('border-red-500').addClass('border-green-500');
            notificationIcon.html(`
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            `);
        } else {
            notification.find('.border-l-4').removeClass('border-green-500').addClass('border-red-500');
            notificationIcon.html(`
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `);
        }

        // Tampilkan notifikasi
        notification.removeClass('translate-x-full').addClass('translate-x-0');

        // Sembunyikan setelah 3 detik
        setTimeout(hideNotification, 3000);
    }

    function hideNotification() {
        $('#notification').removeClass('translate-x-0').addClass('translate-x-full');
    }

    // Tambahkan fungsi untuk memperbarui tabel IRS
    function updateIRSTable() {
        const tbody = $('#selectedIRSTable');
        tbody.empty();

        let totalSKS = 0;
        let no = 1;

        // Filter jadwal yang sudah dipilih
        const selectedJadwals = jadwalData.filter(j => j.is_selected);

        selectedJadwals.forEach(jadwal => {
            const sks = jadwal.sks || 3; // Gunakan SKS dari data atau default ke 3
            totalSKS += sks;

            tbody.append(`
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">${no++}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">${jadwal.kode_mk}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">${jadwal.nama_mk}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">${jadwal.kelas}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">Baru</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">${sks}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                        <button class="text-red-600 delete-jadwal hover:text-red-900"
                                data-jadwal-id="${jadwal.id}"
                                title="Hapus Jadwal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </td>
                </tr>
            `);
        });

        // Update total SKS
        $('#totalSKS').text(totalSKS);

        // Update jumlah SKS di header
        $('.text-2xl.font-bold:contains("IRS")').text(`IRS (${totalSKS} SKS)`);
    }

    // Tambahkan event handler untuk tombol hapus jadwal
    $(document).on('click', '.delete-jadwal', function() {
        const jadwalId = $(this).data('jadwal-id');
        const jadwal = jadwalData.find(j => j.id === jadwalId);

        if (!jadwal) return;

        // Tampilkan modal konfirmasi
        deleteJadwalInfo = jadwal;
        $('#hapusModalMataKuliah').text(jadwal.nama_mk);
        $('#hapusModalKode').text(`Kode MK: ${jadwal.kode_mk}`);
        $('#hapusModalKelas').text(`Kelas: ${jadwal.kelas}`);
        $('#hapusModalWaktu').text(`Waktu: ${jadwal.hari}, ${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}`);
        $('#hapusModalRuang').text(`Ruang: ${jadwal.ruang}`);
        $('#konfirmasiHapusModal').removeClass('hidden');
    });

    // Event handler untuk tombol batal hapus
    $('#cancelHapus').on('click', function() {
        $('#konfirmasiHapusModal').addClass('hidden');
        deleteJadwalInfo = null;
    });

    // Event handler untuk tombol konfirmasi hapus
    $('#confirmHapus').on('click', function() {
        if (!deleteJadwalInfo) return;

        $.ajax({
            url: `/pengambilan-irs/${deleteJadwalInfo.id}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Reset status jadwal
                    deleteJadwalInfo.is_selected = false;
                    deleteJadwalInfo.mk_selected = false;
                    selectedJadwal.delete(deleteJadwalInfo.kode_mk);

                    // Reset status bertabrakan untuk jadwal lain
                    jadwalData.forEach(j => {
                        if (j.hari === deleteJadwalInfo.hari) {
                            j.is_bertabrakan = false;
                        }
                        if (j.kode_mk === deleteJadwalInfo.kode_mk) {
                            j.mk_selected = false;
                        }
                    });

                    // Update tampilan
                    updateJadwalDisplay();
                    updateListMataKuliah();
                    updateIRSTable();

                    // Kurangi kuota terisi
                    deleteJadwalInfo.kuota_terisi--;

                    // Sembunyikan modal
                    $('#konfirmasiHapusModal').addClass('hidden');
                    deleteJadwalInfo = null;

                    showNotification('Jadwal berhasil dihapus');
                }
            },
            error: function(xhr) {
                const message = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                showNotification('Gagal menghapus jadwal: ' + message, 'error');
                $('#konfirmasiHapusModal').addClass('hidden');
                deleteJadwalInfo = null;
            }
        });
    });

    // Tutup modal saat klik backdrop
    $('#konfirmasiHapusModal').on('click', function(e) {
        if (e.target === this) {
            $(this).addClass('hidden');
            deleteJadwalInfo = null;
        }
    });
});
</script>
@endpush
