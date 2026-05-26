<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table; // Pastikan ini ada

class TableSeeder extends Seeder
{
    public function run(): void
    {
        // Menambah data meja baru
        Table::create(['name' => 'Meja VIP 01', 'capacity' => 2]);
        Table::create(['name' => 'Meja Keluarga 01', 'capacity' => 6]);
        Table::create(['name' => 'Meja Outdoor 01', 'capacity' => 4]);
    }
}