<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal;

return new class extends Migration
{
    public function up()
    {
        DB::table('jadwal')->where('status', 'Sudah Disetujui')->update(['status' => 'disetujui']);
        DB::table('jadwal')->where('status', 'Menunggu Persetujuan')->update(['status' => 'pending']);
        DB::table('jadwal')->where('status', 'Ditolak')->update(['status' => 'ditolak']);
    }

    public function down()
    {
        DB::table('jadwal')->where('status', 'disetujui')->update(['status' => 'Sudah Disetujui']);
        DB::table('jadwal')->where('status', 'pending')->update(['status' => 'Menunggu Persetujuan']);
        DB::table('jadwal')->where('status', 'ditolak')->update(['status' => 'Ditolak']);
    }
}; 