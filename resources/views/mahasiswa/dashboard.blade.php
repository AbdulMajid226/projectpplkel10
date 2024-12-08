@extends('layouts.mahasiswa')

@section('content')
<div class="space-y-6">
    <!-- Dasbor -->
    <h1 class="text-2xl font-bold">Dasbor</h1>

    <div class="flex flex-wrap gap-6">
        <!-- Status Akademik -->
        <?php
        $bgColor = 'bg-emerald-500'; // Default color

        if ($mahasiswa->status == 'Belum Registrasi') {
            $bgColor = 'bg-red-500';
        } elseif ($mahasiswa->status == 'Cuti') {
            $bgColor = 'bg-teal-900';
        }
        ?>

        <div class="{{ $bgColor }} rounded-2xl p-4 text-white w-96">
            <h2 class="text-lg font-semibold mb-3">Status Akademik</h2>

            <h1 class="text-3xl font-medium mb-6">{{ $mahasiswa->status }}</h1>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm opacity-80 mb-1">Semester Akademik</p>
                    @php
                        $tahunAjaran = explode(' ', $mahasiswa->tahun_ajaran_aktif);
                        $semester = $tahunAjaran[0] ?? '';
                        $tahun = $tahunAjaran[1] ?? '';
                    @endphp
                    <p class="text-lg">{{ $tahun }}</p>
                    <p class="text-lg font-medium">{{ $semester }}</p>
                </div>
                <div>
                    <p class="text-sm opacity-80 mb-1">Semester Studi</p>
                    <p class="text-2xl font-medium">{{ $mahasiswa->semester_aktif }}</p>
                </div>
            </div>

            <div class="border-t border-white/20 pt-3">
                <p class="text-sm opacity-80 mb-1">Dosen Wali:</p>
                @if($mahasiswa->pembimbingAkademik)
                    <p class="text-lg font-medium">{{ $mahasiswa->pembimbingAkademik->nama }}</p>
                    <p class="text-sm opacity-80">(NIDN: {{ $mahasiswa->pembimbingAkademik->nidn }})</p>
                @else
                    <p class="text-lg italic">Belum ditentukan</p>
                @endif
            </div>
        </div>

        <!-- Prestasi Akademik -->
        <div class="bg-white rounded-2xl p-4 shadow w-96">
            <h2 class="text-lg font-semibold mb-4">Prestasi akademik</h2>

            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-600">IPK</p>
                    <p class="text-2xl font-bold">3.81</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">SKSK</p>
                    <p class="text-2xl font-bold">84</p>
                </div>
            </div>

            <div class="h-40">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Jadwal -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Jadwal</h2>
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-teal-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Hari</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Waktu</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Ruang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">SKS</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Semester</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Kelas</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">Rekayasa Perangkat Lunak</td>
                            <td class="px-6 py-4">Selasa</td>
                            <td class="px-6 py-4">13.00 - 16.20</td>
                            <td class="px-6 py-4">E101</td>
                            <td class="px-6 py-4">4</td>
                            <td class="px-6 py-4">5</td>
                            <td class="px-6 py-4">D</td>
                            <td class="px-6 py-4">
                                <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-emerald-500 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">15/15 Hadir</p>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">Manajemen Basis Data</td>
                            <td class="px-6 py-4">Rabu</td>
                            <td class="px-6 py-4">09.40 - 12.10</td>
                            <td class="px-6 py-4">E101</td>
                            <td class="px-6 py-4">3</td>
                            <td class="px-6 py-4">5</td>
                            <td class="px-6 py-4">D</td>
                            <td class="px-6 py-4">
                                <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-emerald-500 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">15/15 Hadir</p>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">Pemrograman Berorientasi Objek</td>
                            <td class="px-6 py-4">Rabu</td>
                            <td class="px-6 py-4">15.40 - 18.10</td>
                            <td class="px-6 py-4">A303</td>
                            <td class="px-6 py-4">3</td>
                            <td class="px-6 py-4">5</td>
                            <td class="px-6 py-4">D</td>
                            <td class="px-6 py-4">
                                <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-emerald-500 h-2.5 rounded-full" style="width: 100%"></div>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">15/15 Hadir</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5'],
            datasets: [{
                label: 'IPK',
                data: [3.5, 3.6, 3.7, 3.75, 3.81],
                borderColor: '#10b981',
                backgroundColor: '#10b98120',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 2.5,
                    max: 4.0,
                    ticks: {
                        stepSize: 0.5
                    }
                }
            }
        }
    });
</script>
@endsection
