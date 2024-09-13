<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RWseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        {
            DB::table('rw')->insert([
                ['id' => 1, 'rukun_warga' => '1 KARANG ANYAR', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'rukun_warga' => '2 KARANG ANYAR', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'rukun_warga' => '3 SIGENDENG', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 4, 'rukun_warga' => '4 KAMPUNG MELATI', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 5, 'rukun_warga' => '5 KESAMBI BARU', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 6, 'rukun_warga' => '6 ASRAMA TNI-AD', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 7, 'rukun_warga' => '7 WARNASARI', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
