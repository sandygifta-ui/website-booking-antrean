<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Table;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Matikan cek foreign key sebentar supaya bisa truncate/hapus data dengan bersih
        Schema::disableForeignKeyConstraints();
        Table::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Buat Akun Admin untuk Login
        User::create([
            'name' => 'Admin Yaya',
            'email' => 'admin@resto.com',
            'password' => Hash::make('password123'), // Password kamu untuk login
        ]);

        // 3. Buat Daftar Meja Restoran
        Table::create([
            'name' => 'Meja VIP 01',
            'capacity' => 2
        ]);

        Table::create([
            'name' => 'Meja Keluarga 01',
            'capacity' => 6
        ]);

        Table::create([
            'name' => 'Meja Outdoor 01',
            'capacity' => 4
        ]);

        Table::create([
            'name' => 'Meja Bar 01',
            'capacity' => 1
        ]);
    }
}