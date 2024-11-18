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
        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'Jhon@lecturer.ac.id',
            'password' => Hash::make('12345678'), // Menggunakan Hash untuk password
            'role' => 'pa',
        ]);

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
    }
}