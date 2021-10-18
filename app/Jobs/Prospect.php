<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\MasterData;
use Illuminate\Support\Facades\DB;

class Prospect implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Cache::forget('lis202101');
        Cache::forget('lis202102');

        Cache::rememberForever('lis202101', function(){
            // $lis202101 =  DB::connection('pg3')->table('MASTERDATATREG6VER202101')
            $lis202101 =  DB::connection('pg3')->table('MASTERDATATREG6')
            ->select(
                DB::raw("(count(1)) as count")
            )
            // ->where('is_lis', '1')
            // ->where('cprod','11')
            // ->where('linecats_item_id', '<', '400')
            // ->where('plblcl_trems', 'PL')->count();
            ->where('lis_prm','1')->count();
            return $lis202101;
        });

        Cache::rememberForever('lis202102', function(){
            // $lis202102 =  DB::connection('pg3')->table('MASTERDATATREG6VER202102')
            $lis202102 = DB::connection('pg3')->table('MASTERDATATREG6')
            ->select(
                DB::raw("(count(1)) as count")
            )
            // ->where('is_lis', '1')
            // ->where('cprod','11')
            // ->where('linecats_item_id', '<', '400')
            // ->where('plblcl_trems', 'PL')->count();
            ->where('lis_prm','1')->count();
            return $lis202102;
        });
    }
}
