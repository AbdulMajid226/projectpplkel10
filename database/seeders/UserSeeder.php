<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Pembimbing Akademik
        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'Jhon@lecturer.ac.id',
            'password' => Hash::make('12345678'), // Menggunakan Hash untuk password
            'role' => 'pa',
        ]);

        //Mahasiswa
        User::create([
            'name' => 'Alice',
            'email' => 'Alice@students.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'mhs',
        ]);
        
        User::create([
            'name' => 'Bob',
            'email' => 'Bob@students.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'mhs',
        ]);

        //Bagian Akademik
        User::create([
            'name' => 'Admin Sains dan Matematika',
            'email' => 'adminSains@academic.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'ba',
        ]);
        
        User::create([
            'name' => 'Admin Teknik',
            'email' => 'adminteknik@academic.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'ba',
        ]);

        //Dekan
        User::create([
            'name' => 'Dr. Ir. Ahmad',
            'email' => 'Ahmad@dean.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'dk',
        ]);
        
        User::create([
            'name' => 'Prof. Bambang',
            'email' => 'Bambang@dean.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'dk',
        ]);

        //Kaprodi
        User::create([
            'name' => 'Dr. Eko',
            'email' => 'Eko@programhead.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'kpr',
        ]);
        
        User::create([
            'name' => 'Dr. Fajar',
            'email' => 'Fajar@programhead.ac.id',
            'password' => Hash::make('12345678'),
            'role' => 'kpr',
        ]);

    }
}