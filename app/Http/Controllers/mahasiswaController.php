<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class mahasiswaController extends Controller
{
    public function setStatusAktif(Request $request)
    {
        $mahasiswa = auth('web')->user()->mahasiswa;

        if ($mahasiswa->status === 'Belum Registrasi') {
            $mahasiswa->status = 'Aktif';
            $mahasiswa->save();

            return redirect()->route('dashboard_mhs')
                ->with('success', 'Status berhasil diubah menjadi Aktif. Silakan isi IRS Anda.');
        }

        return redirect()->back()
            ->with('error', 'Anda tidak dapat mengubah status karena sudah teregistrasi.');
    }

    public function setStatusCuti(Request $request)
    {
        $mahasiswa = auth('web')->user()->mahasiswa;

        if ($mahasiswa->status === 'Belum Registrasi') {
            $mahasiswa->status = 'Cuti';
            $mahasiswa->save();

            return redirect()->route('dashboard_mhs')
                ->with('success', 'Status berhasil diubah menjadi Cuti.');
        }

        return redirect()->back()
            ->with('error', 'Anda tidak dapat mengubah status karena sudah teregistrasi.');
    }
}