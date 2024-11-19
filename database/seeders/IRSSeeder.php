<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IRS;

class IRSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        IRS::create([
            'nim' => '24060122130001',
            'status_persetujuan' => 'Pending',
            'tanggal_persetujuan' => null ,
        ]);

        
        IRS::create([
            'nim' => '24060122130002',
            'status_persetujuan' => 'Pending',
            'tanggal_persetujuan' => null ,
        ]);
    }
}