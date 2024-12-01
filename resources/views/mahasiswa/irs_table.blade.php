<div class="bg-white">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">No</th>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Kode Mata Kuliah</th>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Nama Mata Kuliah</th>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Semester</th>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Kelas</th>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-base font-semibold text-gray-700 uppercase">SKS</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($matakuliah as $index => $mk)
            <tr>
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ $mk['kode_mk'] }}</td>
                <td class="px-6 py-4">{{ $mk['nama_mk'] }}</td>
                <td class="px-6 py-4">{{ $mk['semester'] }}</td>
                <td class="px-6 py-4">{{ $mk['kelas'] }}</td>
                <td class="px-6 py-4">{{ $mk['status'] }}</td>
                <td class="px-6 py-4">{{ $mk['sks'] }}</td>
            </tr>
            @endforeach
            
            <!-- Baris Total SKS -->
            <tr class="bg-gray-50 font-semibold">
                <td colspan="6" class="px-6 py-4 text-right">Total SKS:</td>
                <td class="px-6 py-4">
                    @php
                    $totalSks = array_sum(array_column($matakuliah, 'sks'));
                    @endphp
                    {{ $totalSks }}
                </td>
            </tr>
        </tbody>
    </table>
</div> 