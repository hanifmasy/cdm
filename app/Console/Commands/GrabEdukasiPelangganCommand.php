<?php

namespace App\Console\Commands;

use App\Jobs\GrabEdukasiPelanggan;
use Illuminate\Console\Command;

class GrabEdukasiPelangganCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grab:edukasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab Dapros Edukasi Pelanggan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        GrabEdukasiPelanggan::dispatch();
    }
}
