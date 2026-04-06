<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Super Admin
        User::create([
            'name' => 'Super Admin Optik',
            'email' => 'admin@optik.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin'
        ]);

        // Buat Akun Pelanggan Default
        User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);
    }
}