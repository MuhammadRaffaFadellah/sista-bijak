<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rt')->insert([
            ['id' => 1, 'rw_id' => 1, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'rw_id' => 1, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'rw_id' => 1, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'rw_id' => 1, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'rw_id' => 1, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'rw_id' => 2, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'rw_id' => 2, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'rw_id' => 2, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'rw_id' => 2, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'rw_id' => 2, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'rw_id' => 2, 'nama' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'rw_id' => 2, 'nama' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'rw_id' => 3, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'rw_id' => 3, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'rw_id' => 3, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'rw_id' => 3, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'rw_id' => 3, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'rw_id' => 3, 'nama' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'rw_id' => 3, 'nama' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'rw_id' => 3, 'nama' => '8', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'rw_id' => 4, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'rw_id' => 4, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'rw_id' => 4, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'rw_id' => 4, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'rw_id' => 4, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'rw_id' => 4, 'nama' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'rw_id' => 4, 'nama' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 28, 'rw_id' => 5, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 29, 'rw_id' => 5, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 30, 'rw_id' => 5, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 31, 'rw_id' => 5, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'rw_id' => 5, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 33, 'rw_id' => 6, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 34, 'rw_id' => 6, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 35, 'rw_id' => 6, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 36, 'rw_id' => 6, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 37, 'rw_id' => 6, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 38, 'rw_id' => 6, 'nama' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 39, 'rw_id' => 6, 'nama' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 40, 'rw_id' => 6, 'nama' => '8', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 41, 'rw_id' => 6, 'nama' => '9', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 42, 'rw_id' => 7, 'nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 43, 'rw_id' => 7, 'nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 44, 'rw_id' => 7, 'nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 45, 'rw_id' => 7, 'nama' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 46, 'rw_id' => 7, 'nama' => '5', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
