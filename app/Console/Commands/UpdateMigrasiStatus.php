<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Migrasi;
use Carbon\Carbon;

class UpdateMigrasiStatus extends Command
{
    protected $signature = 'migrasi:update-status';
    protected $description = 'Update status migrasi to menetap if more than 3 months have passed since the migration date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        Migrasi::where('jenis_migrasi', 'masuk')
            ->where('created_at', '<=', $threeMonthsAgo)
            ->where('status', 'migrasi')
            ->update(['status' => 'menetap']);

        $this->info('Migrasi status updated successfully.');
    }
}