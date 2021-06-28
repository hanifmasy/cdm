<?php

namespace App\Jobs;

use App\Models\ClusterIndihome;
use App\Models\ClusterNormal;
use App\Models\ClusterNotnormal;
use App\Models\ClusterSpeedPcrf;
use App\Models\ClusterUsageInet;
use App\Models\ClusterUsageTv;
use App\Models\ClusterUsia;
use App\Models\NotnormalBillModemOff;
use App\Models\NotnormalBillOff;
use App\Models\NotnormalModemOff;
use App\Models\Segmen;
use App\Models\SegmenNormal;
use App\Models\SegmenNotnormal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class Dashboard implements ShouldQueue
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
        Cache::forget('countBisnis');
        Cache::forget('countCustomer');
        Cache::forget('countGovernment');
        Cache::forget('countPersonal');
        Cache::forget('segmenNormal');
        Cache::forget('segmenAbnormal');
        Cache::forget('clusterNormal');
        Cache::forget('clusterAbnormal');
        Cache::forget('modemOff');
        Cache::forget('billOff');
        Cache::forget('modemBillOff');
        Cache::forget('clusterUsia');
        Cache::forget('clusterSpeedpcrf');
        Cache::forget('clusterIndihome');
        Cache::forget('clusterUsageinet');
        Cache::forget('clusterUsagetv');
        Cache::rememberForever('countBisnis', function(){
            return Segmen::where('plblcl_trems', 'BL')->select('count')->first();
        });
        Cache::rememberForever('countCustomer', function(){
            return Segmen::where('plblcl_trems', 'CL')->select('count')->first();
        });
        Cache::rememberForever('countGovernment', function(){
            return Segmen::where('plblcl_trems', 'GL')->select('count')->first();
        });
        Cache::rememberForever('countPersonal', function(){
            return Segmen::where('plblcl_trems', 'PL')->select('count')->first();
        });
        Cache::rememberForever('segmenNormal', function(){
            $segmenNormal = SegmenNormal::select('notel')->count();
            return $segmenNormal ?? 0;
        });
        Cache::rememberForever('segmenAbnormal', function(){
            $segmenAbnormal =  SegmenNotnormal::select('notel')->count();
            return $segmenAbnormal ?? 0;
        });
        Cache::rememberForever('clusterNormal', function(){
            $cluster_normal = ClusterNormal::selectRAW('cluster_rev, count(*)')->where('cluster_rev', '!=', null)->groupBy('cluster_rev')->get()->toArray();
            return $cluster_normal;
        });
        Cache::rememberForever('clusterAbnormal', function(){
            $cluster_not_normal = ClusterNotnormal::selectRAW('cluster_rev, count(*)')->where('cluster_rev', '!=', null)->groupBy('cluster_rev')->get()->toArray();
            return $cluster_not_normal;
        });
        Cache::rememberForever('clusterUsia', function(){
            $cluster_usia = ClusterUsia::selectRAW('cluster_usia_ps, count(*)')->where('cluster_usia_ps', '!=', null)->groupBy('cluster_usia_ps','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_usia;
        });
        Cache::rememberForever('clusterSpeedpcrf', function(){
            $cluster_speedpcrf = ClusterSpeedPcrf::selectRAW('cluster_speed_pcrf, count(*)')->where('cluster_speed_pcrf', '!=', null)->groupBy('cluster_speed_pcrf','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_speedpcrf;
        });
        Cache::rememberForever('clusterIndihome', function(){
            $cluster_indihome = ClusterIndihome::selectRAW('cluster_indihome, count(*)')->where('cluster_indihome', '!=', null)->groupBy('cluster_indihome','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_indihome;
        });
        Cache::rememberForever('clusterUsageinet', function(){
            $cluster_usageinet = ClusterUsageInet::selectRAW('cluster_usage_inet, count(*)')->where('cluster_usage_inet', '!=', null)->groupBy('cluster_usage_inet','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_usageinet;
        });
        Cache::rememberForever('clusterUsagetv', function(){
            $cluster_usageinet = ClusterUsageTv::selectRAW('cluster_usage_tv, count(*)')->where('cluster_usage_tv', '!=', null)->groupBy('cluster_usage_tv','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_usageinet;
        });
        Cache::rememberForever('modemOff', function(){
            $modem_off = NotnormalModemOff::select('notel')->count();
            return $modem_off ?? 0;
        });
        Cache::rememberForever('billOff', function(){
            $bill_off = NotnormalBillOff::select('notel')->count();
            return $bill_off ?? 0;
        });
        Cache::rememberForever('modemBillOff', function(){
            $modemBill_off = NotnormalBillModemOff::select('notel')->count();
            return $modemBill_off ?? 0;
        });
    }
}
