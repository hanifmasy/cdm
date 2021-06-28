<?php

namespace App\Console\Commands;

use App\Jobs\Dashboard2;
use Illuminate\Console\Command;

class DashboardCommand2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:counter2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab Data H+1';

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
        Dashboard2::dispatch();
    }
}
