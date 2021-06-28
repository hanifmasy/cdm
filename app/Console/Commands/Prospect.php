<?php

namespace App\Console\Commands;

use App\Jobs\Prospect as JobsProspect;
use Illuminate\Console\Command;

class Prospect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:prospect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save Query Count Data Prospect';

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
        JobsProspect::dispatch();
    }
}
