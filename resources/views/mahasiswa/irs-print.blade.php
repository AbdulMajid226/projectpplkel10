<!DOCTYPE html>
<html>
<head>
    <style>
        h2 { text-align: center }
        .header { text-align: center; font-size: 12px; margin-bottom: 40px }
        .header p { margin-bottom: -12px }
        .title { text-align: center; font-size: 12px; margin-bottom: 40px }
        .title p { font-weight: bold; margin-bottom: -12px }
        .content { border-collapse: collapse; font-size: 10px; margin-left: auto; margin-right: auto; width: 100% }
        .content table, .content td, .content th { border: 0.5px solid #000 }
        .identitas { font-size: 11px }
        .ttd { font-size: 11px; margin-left: auto; margin-right: auto; width: 100% }
        div.relative { position: relative; width: 400px; height: 200px; border: 3px solid #73ad21 }
        div.absolute { position: absolute; top: 20px; right: 20px; width: 75px; height: 100px; border: 0.5px solid }
        @page { size: a4 portrait; }
        .center { text-align: center }
    </style>
    <script>window.print();</script>
    <title>Print IRS</title>
</head>
<body>
    <div class="absolute">
        <img class="absolute" src="{{ $irs->mahasiswa->foto_url ?? 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" alt="foto.jpg" style="width: 75px;height: 100px;">    </div>

    <div class="header">
        <p>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</p>
        <p>{{ strtoupper($irs->mahasiswa->programStudi->fakultas->nama ?? 'FAKULTAS UNDEFINED') }}</p>
        <p>UNIVERSITAS DIPONEGORO</p>
    </div>

    <div class="title">
        <p>ISIAN RENCANA STUDI</p>
        <p>Semester {{ $irs->semester }} TA {{ $irs->thn_ajaran }}</p>
    </div>

    <div>
        <table class="identitas">
            <tr>
                <td>NIM</td>
                <td style="width: 5px;">:</td>
                <td>{{ $irs->mahasiswa->nim ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 80px;">Nama Mahasiswa</td>
                <td style="width: 5px;">:</td>
                <td>{{ $irs->mahasiswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td style="width: 5px;">:</td>
                <td>{{ $irs->mahasiswa->programStudi->nama_prodi ?? '-' }}</td>
            </tr>
            <tr>
                <td>Dosen Wali</td>
                <td style="width: 5px;">:</td>
                <td>{{ $irs->mahasiswa->pembimbingAkademik->nama ?? '-' }}</td>
            </tr>
        </table>
    </div>
    <br/>
    <div>
        <table class="content" cellpadding="2">
            <thead>
                <tr>
                    <th style="width: 5px;">NO</th>
                    <th style="width: 40px;">KODE</th>
                    <th style="width: 200px;">MATA KULIAH</th>
                    <th style="width: 40px;">KELAS</th>
                    <th style="width: 40px;">SKS</th>
                    <th style="width: 60px;">RUANG</th>
                    <th style="width: 60px;">STATUS</th>
                    <th style="width: 200px;">NAMA DOSEN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($irs->pengambilanIrs as $index => $pengambilan)
                    <tr>
                        <td rowspan="2" class="center">{{ $index + 1 }}</td>
                        <td>{{ $pengambilan->jadwal->kode_mk ?? '-' }}</td>
                        <td>{{ $pengambilan->jadwal->mataKuliah->nama ?? '-' }}</td>
                        <td class="center">{{ $pengambilan->jadwal->kelas ?? '-' }}</td>
                        <td class="center">{{ $pengambilan->jadwal->mataKuliah->sks ?? 0 }}</td>
                        <td class="center">{{ $pengambilan->jadwal->ruang->kode_ruang ?? '-' }}</td>
                        <td class="center">{{ $pengambilan->status_pengambilan ?? '-' }}</td>
                        {{-- <td class="center">{{ $pengambilan->jadwal->dosen->nama ?? '-' }}</td> --}}
                        <td>
                            @foreach($pengambilan->jadwal->mataKuliah->pengampuanDosen as $dosen)
                                {{ $dosen->nama ?? '-' }}<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            {{ $pengambilan->jadwal->hari ?? '' }} pukul 
                            @php
                                $jamMulai = Carbon\Carbon::parse($pengambilan->jadwal->waktu->waktu_mulai)->format('H:i');
                                $sks = $pengambilan->jadwal->mataKuliah->sks;
                                $durasiMenit = $sks * 50;
                                $jamSelesai = Carbon\Carbon::parse($pengambilan->jadwal->waktu->waktu_mulai)->addMinutes($durasiMenit)->format('H:i');
                            @endphp
                            {{ $jamMulai }} - {{ $jamSelesai }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <table class="ttd">
            <thead>
                <tr>
                    <th style="width:200px">&nbsp;</th>
                    <th style="width:200px">&nbsp;</th>
                    <th style="width:auto">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Semarang, {{ $today }}</td>
                </tr>
                <tr>
                    <td>Pembimbing Akademik (Dosen Wali)</td>
                    <td></td>
                    <td>Nama Mahasiswa,</td>
                </tr>
                @for($i = 0; $i < 13; $i++)
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                @endfor
                <tr>
                    <td>{{ $irs->mahasiswa->pembimbingAkademik->nama ?? '-' }}</td>
                    <td></td>
                    <td>{{ $irs->mahasiswa->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>NIDN. {{ $irs->mahasiswa->pembimbingAkademik->nidn ?? '-' }}</td>
                    <td></td>
                    <td>NIM. {{ $irs->mahasiswa->nim ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>