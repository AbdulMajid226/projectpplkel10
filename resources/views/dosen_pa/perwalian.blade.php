@extends('layouts.dosen_pa')

@section('title', 'Perwalian')

@section('content')

<div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Mahasiswa Perwalian</h1>
        <p class="mt-2 text-gray-600">Halaman ini menampilkan detail IRS mahasiswa perwalian</p>
    </div>
    <div class="mt-4 md:mt-0">
        <span class="px-4 py-2 text-sm font-semibold text-teal-800 bg-teal-100 rounded-full">
            Semester Ganjil 2024/2025
        </span>
    </div>
</div>
    <div class="container px-4 mx-auto">

<!-- Filter dan Pencarian -->
<div class="flex flex-wrap gap-4 mb-6">
    <select id="prodi" class="w-48 p-2 border rounded focus:outline-none focus:border-teal-500">
        <option value="" >Pilih Program Studi</option>
        <option value="ARS">Arsitektur</option>
        <option value="BIO">Biologi</option>
        <option value="ELK">Teknik Elektro</option>
        <option value="FIS">Fisika</option>
        <option value="IF">Informatika</option>
        <option value="MIK">Matematika</option>
        <option value="SI">Sistem Informasi</option>
        <option value="TI">Teknik Industri</option>
    </select>

    <select id="angkatan" class="w-48 p-2 border rounded focus:outline-none focus:border-teal-500">
        <option value="">Pilih Angkatan</option>
        @for($i = date('Y'); $i >= date('Y')-4; $i--)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <input type="text"
        id="searchInput"
        placeholder="Nama/NIM mahasiswa..."
        class="p-2 border rounded focus:outline-none focus:border-teal-500">

    <button onclick="searchMahasiswa()"
        class="px-4 py-2 text-white bg-teal-600 rounded hover:bg-teal-700">
        Cari
    </button>
</div>

<!-- Hasil Pencarian -->
<div id="searchResults" class="mt-4">
    <!-- Hasil pencarian akan ditampilkan di sini -->
</div>

<!-- Script untuk pencarian -->
<script>
function searchMahasiswa() {
    const prodi = document.getElementById('prodi').value;
    const angkatan = document.getElementById('angkatan').value;
    const searchTerm = document.getElementById('searchInput').value;

    const searchParams = new URLSearchParams({
        prodi: prodi,
        angkatan: angkatan,
        search: searchTerm
    });

    fetch(`/search-mahasiswa?${searchParams.toString()}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const resultsDiv = document.getElementById('searchResults');
                resultsDiv.innerHTML = '';

                if (data.data.length === 0) {
                    resultsDiv.innerHTML = '<p class="text-gray-600">Tidak ada hasil yang ditemukan</p>';
                    return;
                }

                data.data.forEach(item => {
                    const mhs = item.mahasiswa;
                    const irsData = item.irs_data;

                    let detailHTML = `
                        <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div>
                                    <div class="mb-4">
                                        <label class="block mb-1 text-xl font-semibold text-gray-700">Nama</label>
                                        <p class="text-base font-medium text-gray-900">${mhs.nama}</p>
                                    </div>
                                    <div class="mb-1">
                                        <label class="block mb-1 text-xl font-semibold text-gray-700">NIM</label>
                                        <p class="text-base font-medium text-gray-900">${mhs.nim}</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label class="block mb-1 text-xl font-semibold text-gray-700">Angkatan</label>
                                        <p class="text-base font-medium text-gray-900">${mhs.angkatan}</p>
                                    </div>
                                    <div class="mb-1">
                                        <label class="block mb-1 text-xl font-semibold text-gray-700">Program Studi</label>
                                        <p class="text-base font-medium text-gray-900">${mhs.program_studi.nama_prodi}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- History IRS -->
                            <div class="mt-6">
                                <h3 class="mb-4 text-lg font-semibold">History IRS</h3>
                                <div class="space-y-2">
                                    ${irsData.map(irs => `
                                        <div class="overflow-hidden border rounded-lg">
                                            <button class="flex items-center justify-between w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none"
                                                    onclick="toggleSemesterDetail('${mhs.nim}_${irs.semester}')">
                                                <div class="flex items-center space-x-4">
                                                    <span class="text-lg font-semibold text-blue-600">Semester-${irs.semester}</span>
                                                    <span class="text-gray-600">|</span>
                                                    <span class="text-gray-800">Tahun Ajaran ${irs.thn_ajaran}</span>
                                                </div>
                                                <div class="flex items-center space-x-4">
                                                    <span class="text-gray-600">Total SKS: ${irs.matakuliah.reduce((total, mk) => total + mk.sks, 0)}</span>
                                                    <svg class="w-5 h-5 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </button>

                                            <div class="hidden" id="${mhs.nim}_${irs.semester}_detail">
                                                <div class="bg-white">
                                                    <table class="min-w-full">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">No</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">Kode</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">Mata Kuliah</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">Kelas</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">SKS</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">Ruang</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">Status</th>
                                                                <th class="px-6 py-3 text-base font-semibold text-left text-gray-700 uppercase">Nama Dosen</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-gray-200">
                                                            ${irs.matakuliah.map((mk, index) => `
                                                                <tr>
                                                                    <td class="px-6 py-4">${index + 1}</td>
                                                                    <td class="px-6 py-4">${mk.kode_mk}</td>
                                                                    <td class="px-6 py-4">
                                                                    ${mk.nama_mk}
                                                                    <div class="text-sm text-gray-500">${mk.waktu}</div>
                                                                    </td>
                                                                    <td class="px-6 py-4">${mk.kelas}</td>
                                                                    <td class="px-6 py-4">${mk.sks}</td>
                                                                    <td class="px-6 py-4">${mk.ruang}</td>
                                                                    <td class="px-6 py-4">${mk.status_pengambilan}</td>
                                                                    <td class="px-6 py-4">${mk.nama_dosen}</td>
                                                                </tr>
                                                            `).join('')}
                                                        </tbody>
                                                    </table>

                                                    <!-- Tombol Print PDF -->
                                                    <div class="px-6 py-3 border-t bg-gray-50">
                                                        <a href="/irs/print/${irs.semester}/${irs.thn_ajaran.replace('/', '_')}"
                                                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-md shadow-sm hover:bg-blue-700">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                            </svg>
                                                            Print PDF
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>

                        </div>
                    `;
                    resultsDiv.innerHTML += detailHTML;
                });
            } else {
                alert('Gagal melakukan pencarian: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat melakukan pencarian');
        });
}

function toggleSemesterDetail(id) {
    const content = document.getElementById(`${id}_detail`);
    if (content) {
        content.classList.toggle('hidden');
    }
}
</script>


</div>
@endsection
