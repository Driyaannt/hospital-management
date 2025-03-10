<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    User::create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'Dokter',
        'username' => 'dokter',
        'email' => 'dokter@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'dokter',
    ]);

    User::create([
        'name' => 'Perawat',
        'username' => 'perawat',
        'email' => 'perawat@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'perawat',
    ]);

    User::create([
        'name' => 'Apoteker',
        'username' => 'apoteker',
        'email' => 'apoteker@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'apoteker',
    ]);
}
}
