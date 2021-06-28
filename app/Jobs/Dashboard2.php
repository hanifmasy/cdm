<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\DashboardH1\ClusterIndihome;
use App\Models\DashboardH1\ClusterNormal;
use App\Models\DashboardH1\ClusterNotNormal;
use App\Models\DashboardH1\ClusterSpeedPcrf;
use App\Models\DashboardH1\ClusterUsageInet;
use App\Models\DashboardH1\ClusterUsageTv;
use App\Models\DashboardH1\ClusterUsia;
use App\Models\DashboardH1\NotNormalBillModemOff;
use App\Models\DashboardH1\NotNormalBillOff;
use App\Models\DashboardH1\NotNormalModemOff;
use App\Models\DashboardH1\Segmen;
use App\Models\DashboardH1\SegmenNormal;
use App\Models\DashboardH1\SegmenNotNormal;
use Illuminate\Support\Facades\Cache;

class Dashboard2 implements ShouldQueue
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
        Cache::forget('countBisnis2');
        Cache::forget('countCustomer2');
        Cache::forget('countGovernment2');
        Cache::forget('countPersonal2');
        Cache::forget('segmenNormal2');
        Cache::forget('segmenAbnormal2');
        Cache::forget('clusterNormal2');
        Cache::forget('clusterAbnormal2');
        Cache::forget('modemOff2');
        Cache::forget('billOff2');
        Cache::forget('modemBillOff2');
        Cache::forget('clusterUsia2');
        Cache::forget('clusterSpeedpcrf2');
        Cache::forget('clusterIndihome2');
        Cache::forget('clusterUsageinet2');
        Cache::forget('clusterUsagetv2');
        Cache::rememberForever('countBisnis2', function(){
            return Segmen::where('plblcl_trems', 'BL')->select('count')->first();
        });
        Cache::rememberForever('countCustomer2', function(){
            return Segmen::where('plblcl_trems', 'CL')->select('count')->first();
        });
        Cache::rememberForever('countGovernment2', function(){
            return Segmen::where('plblcl_trems', 'GL')->select('count')->first();
        });
        Cache::rememberForever('countPersonal2', function(){
            return Segmen::where('plblcl_trems', 'PL')->select('count')->first();
        });
        Cache::rememberForever('segmenNormal2', function(){
            $segmenNormal2 = SegmenNormal::select('notel')->count();
            return $segmenNormal2;
        });
        Cache::rememberForever('segmenAbnormal2', function(){
            $segmenAbnormal2 =  SegmenNotNormal::select('notel')->count();
            return $segmenAbnormal2;
        });
        Cache::rememberForever('clusterNormal2', function(){
            $cluster_normal2 = ClusterNormal::selectRAW('cluster_rev, count(*)')->where('cluster_rev', '!=', null)->groupBy('cluster_rev')->get()->toArray();
            return $cluster_normal2;
        });
        Cache::rememberForever('clusterAbnormal2', function(){
            $cluster_not_normal2 = ClusterNotNormal::selectRAW('cluster_rev, count(*)')->where('cluster_rev', '!=', null)->groupBy('cluster_rev')->get()->toArray();
            return $cluster_not_normal2;
        });
        Cache::rememberForever('clusterUsia2', function(){
            $cluster_usia2 = ClusterUsia::selectRAW('cluster_usia_ps, count(*)')->where('cluster_usia_ps', '!=', null)->groupBy('cluster_usia_ps','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_usia2;
        });
        Cache::rememberForever('clusterSpeedpcrf2', function(){
            $cluster_speedpcrf2 = ClusterSpeedPcrf::selectRAW('cluster_speed_pcrf, count(*)')->where('cluster_speed_pcrf', '!=', null)->groupBy('cluster_speed_pcrf','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_speedpcrf2;
        });
        Cache::rememberForever('clusterIndihome2', function(){
            $cluster_indihome2 = ClusterIndihome::selectRAW('cluster_indihome, count(*)')->where('cluster_indihome', '!=', null)->groupBy('cluster_indihome','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_indihome2;
        });
        Cache::rememberForever('clusterUsageinet2', function(){
            $cluster_usageinet2 = ClusterUsageInet::selectRAW('cluster_usage_inet, count(*)')->where('cluster_usage_inet', '!=', null)->groupBy('cluster_usage_inet','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_usageinet2;
        });
        Cache::rememberForever('clusterUsagetv2', function(){
            $cluster_usageinet2 = ClusterUsageTv::selectRAW('cluster_usage_tv, count(*)')->where('cluster_usage_tv', '!=', null)->groupBy('cluster_usage_tv','sort')->orderBy('sort', 'ASC')->get()->toArray();
            return $cluster_usageinet2;
        });
        Cache::rememberForever('modemOff2', function(){
            $modem_off2 = NotNormalModemOff::select('notel')->count();
            return $modem_off2;
        });
        Cache::rememberForever('billOff2', function(){
            $bill_off2 = NotNormalBillOff::select('notel')->count();
            return $bill_off2;
        });
        Cache::rememberForever('modemBillOff2', function(){
            $modemBill_off2 = NotNormalBillModemOff::select('notel')->count();
            return $modemBill_off2;
        });
    }
}
