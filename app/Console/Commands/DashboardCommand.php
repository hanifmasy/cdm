<?php

namespace App\Console\Commands;

use App\Jobs\Dashboard;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class DashboardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:counter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save Query Count Dashboard';

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
        Dashboard::dispatch();
    }
}
