<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Contoh scheduler yang dijalankan setiap hari
        $schedule->call(function () {
            // Logika update status penduduk di sini
            $threeMonthsAgo = now()->subMonths(3);

            DB::table('penduduk')
                ->where('status', 'Masuk')
                ->where('tanggal_masuk', '<=', $threeMonthsAgo)
                ->update(['status' => 'Menetap']);
        })->daily();  // Kamu bisa ubah sesuai kebutuhan, misal ->monthly() atau lainnya
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // Mendaftarkan command Laravel
        $this->load(__DIR__.'/Commands');

        // Memuat file routes/console.php
        require base_path('routes/console.php');
    }
}
