<?php

namespace App\Http\Controllers\Admin;

use App\Models\DashboardH1\ClusterUsia;
use Illuminate\Support\Facades\Cache;

class HomeController
{
    public function index()
    {         
        // DASHBOARD H  
        $total_cluster_normal = [];
        $total_cluster_notnormal = [];
        $total_cluster_usia = [];
        $total_cluster_speed = [];
        $total_cluster_indihome = [];
        $total_cluster_usageinet = [];
        $total_cluster_usagetv = [];

        $bl = Cache::get('countBisnis');
        $cl = Cache::get('countCustomer');
        $gl = Cache::get('countGovernment');
        $pl = Cache::get('countPersonal');

        $segmen_normal = Cache::get('segmenNormal');
        $segmen_not_normal = Cache::get('segmenAbnormal');
        $total_segmen = $segmen_normal + $segmen_not_normal;

        $seg_normal = @(int)round(($segmen_normal / $total_segmen) * 100);
        $seg_not_normal = @(int)round(($segmen_not_normal / $total_segmen) * 100);

        $cluster_normal = Cache::get('clusterNormal');        
        $cluster_not_normal = Cache::get('clusterAbnormal');

        foreach($cluster_normal as $value) {
            array_push($total_cluster_normal, (int)$value['count']);
        }
        $totalcount_cluster_normal = array_sum($total_cluster_normal);   

        foreach($cluster_not_normal as $value) {
            array_push($total_cluster_notnormal, (int)$value['count']);
        }        
        $totalcount_cluster_notnormal = array_sum($total_cluster_notnormal);

        $platinum_normal = @(int)round(($total_cluster_normal[0] / $totalcount_cluster_normal) * 100);
        $gold_normal = @(int)round(($total_cluster_normal[1] / $totalcount_cluster_normal) * 100);
        $silver_normal = @(int)round(($total_cluster_normal[2] / $totalcount_cluster_normal) * 100);
        $reguler_normal = @(int)round(($total_cluster_normal[3] / $totalcount_cluster_normal) * 100);

        $platinum_not_normal = @(int)round(($total_cluster_notnormal[0] / $totalcount_cluster_notnormal) * 100);
        $gold_not_normal = @(int)round(($total_cluster_notnormal[1] / $totalcount_cluster_notnormal) * 100);
        $silver_not_normal = @(int)round(($total_cluster_notnormal[2] / $totalcount_cluster_notnormal) * 100);
        $reguler_not_normal = @(int)round(($total_cluster_notnormal[3] / $totalcount_cluster_notnormal) * 100);
        $unbill_not_normal = @(int)round(($total_cluster_notnormal[4] / $totalcount_cluster_notnormal) * 100);

        $cluster_indihome = Cache::get('clusterIndihome');

        foreach($cluster_indihome as $value) {
            array_push($total_cluster_indihome, (int)$value['count']);
        }
        $totalcount_cluster_indihome = array_sum($total_cluster_indihome); 
        
        $indihome_2p = @(int)round(($total_cluster_indihome[0] / $totalcount_cluster_indihome) * 100) ?? 0;
        $indihome_3p = @(int)round(($total_cluster_indihome[1] / $totalcount_cluster_indihome) * 100) ?? 0;

        $modem_off = Cache::get('modemOff');
        $bill_off = Cache::get('billOff');
        $modemBill_off = Cache::get('modemBillOff');
        $total_abnormal = $modem_off + $bill_off + $modemBill_off;

        $modem_off_percent = @(int)round(($modem_off / $total_abnormal) * 100) ?? 0;
        $bill_off_percent = @(int)round(($bill_off / $total_abnormal) * 100) ?? 0;
        $modemBill_off_percent = @(int)round(($modemBill_off / $total_abnormal) * 100) ?? 0;

        $cluster_usageinet = Cache::get('clusterUsageinet');
        foreach($cluster_usageinet as $value) {
            array_push($total_cluster_usageinet, (int)$value['count']);
        }         
        $totalcount_cluster_usageinet = array_sum($total_cluster_usageinet);  

        $usageInet1 = @(int)round(($total_cluster_usageinet[0] / $totalcount_cluster_usageinet) * 100) ?? 0;
        $usageInet2 = @(int)round(($total_cluster_usageinet[1] / $totalcount_cluster_usageinet) * 100) ?? 0;
        $usageInet3 = @(int)round(($total_cluster_usageinet[2] / $totalcount_cluster_usageinet) * 100) ?? 0;
        $usageInet4 = @(int)round(($total_cluster_usageinet[3] / $totalcount_cluster_usageinet) * 100) ?? 0;

        // $cluster_usia = Cache::get('clusterUsia');
        // foreach($cluster_usia as $value)
        // {
        //     array_push($total_cluster_usia, (int)$value['count']);
        // }
        // $count_cluster_usia = implode(',', $total_cluster_usia);        
        // $totalcount_cluster_usia = array_sum($total_cluster_usia); 

        $cluster_usia = Cache::get('clusterUsia');
        $arr_cluster_usia = [];
        $arr_0_3_bln = [];

        foreach ($cluster_usia as $val) {
            if ($val['cluster_usia_ps'] === '0-3 bulan') {
                $usia = $val['count'];                
                array_push($arr_0_3_bln, $usia);
            }            
        }

        $arr_sum_0_3_bln = array_sum($arr_0_3_bln);
        array_push($arr_cluster_usia, $arr_sum_0_3_bln);

        foreach ($cluster_usia as $val) {
            if ($val['cluster_usia_ps'] === "4-6 bulan") {
                $usia = $val['count'];
                array_push($arr_cluster_usia, $usia);
            } else if ($val['cluster_usia_ps'] === "7-12 bulan") {
                $usia = $val['count'];
                array_push($arr_cluster_usia, $usia);
            } else if ($val['cluster_usia_ps'] === "1-2 tahun") {
                $usia = $val['count'];
                array_push($arr_cluster_usia, $usia);
            } else if ($val['cluster_usia_ps'] === ">= 2 tahun") {
                $usia = $val['count'];                               
                array_push($arr_cluster_usia, $usia);
            }              
        }    
        $count_cluster_usia = implode(',', $arr_cluster_usia);
        $totalcount_cluster_usia = array_sum($arr_cluster_usia); 

        $cluster_speedpcrf = Cache::get('clusterSpeedpcrf');
        foreach($cluster_speedpcrf as $value)
        {
            array_push($total_cluster_speed, (int)$value['count']);
        }
        $count_cluster_speed = implode(',', $total_cluster_speed);
        $totalcount_cluster_speed = array_sum($total_cluster_speed); 


        $cluster_usagetv = Cache::get('clusterUsagetv');             
        foreach($cluster_usagetv as $value)
        {
            array_push($total_cluster_usagetv, (int)$value['count']);
        }
        $count_cluster_usagetv = implode(',', $total_cluster_usagetv);  
        $totalcount_cluster_usagetv = array_sum($total_cluster_usagetv);  

        $bl = $bl->count ?? 0;
        $cl = $cl->count ?? 0;
        $gl = $gl->count ?? 0;
        $pl = $pl->count ?? 0;
        $segmen_normal = (integer)$segmen_normal ?? 0;
        $segmen_not_normal = (integer)$segmen_not_normal ?? 0;
        $modem_off = (integer)$modem_off ?? 0;
        $bill_off = (integer)$bill_off ?? 0;
        $modemBill_off = (integer)$modemBill_off ?? 0;
        $count_cluster_usia = $count_cluster_usia ?? 0;
        $count_cluster_speed = $count_cluster_speed ?? 0;
        $count_cluster_usagetv = $count_cluster_usagetv ?? 0;

        // DASHBOARD H+1
        // $total_cluster_normal2 = [];
        // $total_cluster_notnormal2 = [];        
        // $total_cluster_speed2 = [];
        // $total_cluster_indihome2 = [];
        // $total_cluster_usageinet2 = [];
        // $total_cluster_usagetv2 = [];

        // $bl2 = Cache::get('countBisnis2');
        // $cl2 = Cache::get('countCustomer2');
        // $gl2 = Cache::get('countGovernment2');
        // $pl2 = Cache::get('countPersonal2');
        // $segmen_normal2 = Cache::get('segmenNormal2');
        // $segmen_not_normal2 = Cache::get('segmenAbnormal2');
        // $cluster_normal2 = Cache::get('clusterNormal2');
        // $cluster_not_normal2 = Cache::get('clusterAbnormal2');
        // $modem_off2 = Cache::get('modemOff2');
        // $bill_off2 = Cache::get('billOff2');
        // $modemBill_off2 = Cache::get('modemBillOff2');
        // $cluster_usia2 = Cache::get('clusterUsia2');
        // $cluster_speedpcrf2 = Cache::get('clusterSpeedpcrf2');
        // $cluster_indihome2 = Cache::get('clusterIndihome2');
        // $cluster_usageinet2 = Cache::get('clusterUsageinet2');
        // $cluster_usagetv2 = Cache::get('clusterUsagetv2'); 
    
        // $total_segmen2 = $segmen_normal2 + $segmen_not_normal2;
        // $total_abnormal2 = $modem_off2 + $bill_off2 + $modemBill_off2;

        // foreach($cluster_normal2 as $value)
        // {
        //     array_push($total_cluster_normal2, (int)$value['count']);
        // }
        // $count_cluster_normal2 = implode(',', $total_cluster_normal2);        
        // $totalcount_cluster_normal2 = array_sum($total_cluster_normal2);           

        // foreach($cluster_not_normal2 as $value)
        // {
        //     array_push($total_cluster_notnormal2, (int)$value['count']);
        // }
        // $count_cluster_notnormal2 = implode(',', $total_cluster_notnormal2);
        // $totalcount_cluster_notnormal2 = array_sum($total_cluster_notnormal2);               
 
        // $arr_cluster_usia = [];
        // $arr_0_3_bln = [];

        // foreach ($cluster_usia2 as $val) {
        //     if ($val['cluster_usia_ps'] === '0-3 bulan') {
        //         $usia = $val['count'];                
        //         array_push($arr_0_3_bln, $usia);
        //     }            
        // }
        
        // $arr_sum_0_3_bln = array_sum($arr_0_3_bln);
        // array_push($arr_cluster_usia, $arr_sum_0_3_bln);

        // foreach ($cluster_usia2 as $val) {
        //     if ($val['cluster_usia_ps'] === "4-6 bulan") {
        //         $usia = $val['count'];
        //         array_push($arr_cluster_usia, $usia);
        //     } else if ($val['cluster_usia_ps'] === "7-12 bulan") {
        //         $usia = $val['count'];
        //         array_push($arr_cluster_usia, $usia);
        //     } else if ($val['cluster_usia_ps'] === "1-2 tahun") {
        //         $usia = $val['count'];
        //         array_push($arr_cluster_usia, $usia);
        //     } else if ($val['cluster_usia_ps'] === "lebih dari 2 tahun") {
        //         $usia = $val['count'];                               
        //         array_push($arr_cluster_usia, $usia);
        //     }              
        // }        
        // $count_cluster_usia2 = implode(',', $arr_cluster_usia);
        // $totalcount_cluster_usia2 = array_sum($arr_cluster_usia);                

        // foreach($cluster_speedpcrf2 as $value)
        // {
        //     array_push($total_cluster_speed2, (int)$value['count']);
        // }
        // $count_cluster_speed2 = implode(',', $total_cluster_speed2);
        // $totalcount_cluster_speed2 = array_sum($total_cluster_speed2);       

        // foreach($cluster_indihome2 as $value)
        // {
        //     array_push($total_cluster_indihome2, (int)$value['count']);
        // }
        // $count_cluster_indihome2 = implode(',', $total_cluster_indihome2);
        // $totalcount_cluster_indihome2 = array_sum($total_cluster_indihome2);        

        // foreach($cluster_usageinet2 as $value)
        // {
        //     array_push($total_cluster_usageinet2, (int)$value['count']);
        // }
        // $count_cluster_usageinet2 = implode(',', $total_cluster_usageinet2);  
        // $totalcount_cluster_usageinet2 = array_sum($total_cluster_usageinet2);  
        
        // foreach($cluster_usagetv2 as $value)
        // {
        //     array_push($total_cluster_usagetv2, (int)$value['count']);
        // }
        // $count_cluster_usagetv2 = implode(',', $total_cluster_usagetv2);  
        // $totalcount_cluster_usagetv2 = array_sum($total_cluster_usagetv2);  

        // $bl2 = $bl2->count;
        // $cl2 = $cl2->count;
        // $gl2 = $gl2->count;
        // $pl2 = $pl2->count;
        // $segmen_normal2 = (integer)$segmen_normal2;
        // $segmen_not_normal2 = (integer)$segmen_not_normal2;
        // $modem_off2 = (integer)$modem_off2;
        // $bill_off2 = (integer)$bill_off2;
        // $modemBill_off2 = (integer)$modemBill_off2;
        // $count_cluster_normal2 = $count_cluster_normal2;
        // $count_cluster_notnormal2 = $count_cluster_notnormal2;
        // $count_cluster_usia2 = $count_cluster_usia2;
        // $count_cluster_speed2 = $count_cluster_speed2;
        // $count_cluster_indihome2 = $count_cluster_indihome2;
        // $count_cluster_usageinet2 = $count_cluster_usageinet2;
        // $count_cluster_usagetv2 = $count_cluster_usagetv2;


        // return view('home', compact('bl', 'cl', 'gl', 'pl', 'segmen_normal', 
        //     'segmen_not_normal', 'count_cluster_normal', 'count_cluster_notnormal',
        //     'modem_off', 'bill_off', 'modemBill_off', 'count_cluster_usia', 
        //     'count_cluster_speed','count_cluster_indihome','count_cluster_usageinet',
        //     'totalcount_cluster_usia','totalcount_cluster_speed','totalcount_cluster_indihome',
        //     'totalcount_cluster_usageinet','count_cluster_usagetv','totalcount_cluster_usagetv',
        //     'totalcount_cluster_normal','totalcount_cluster_notnormal','total_segmen','total_abnormal',
        //     'bl2', 'cl2', 'gl2', 'pl2', 'segmen_normal2', 
        //     'segmen_not_normal2', 'count_cluster_normal2', 'count_cluster_notnormal2',
        //     'modem_off2', 'bill_off2', 'modemBill_off2', 'count_cluster_usia2', 
        //     'count_cluster_speed2','count_cluster_indihome2','count_cluster_usageinet2',
        //     'totalcount_cluster_usia2','totalcount_cluster_speed2','totalcount_cluster_indihome2',
        //     'totalcount_cluster_usageinet2','count_cluster_usagetv2','totalcount_cluster_usagetv2',
        //     'totalcount_cluster_normal2','totalcount_cluster_notnormal2','total_segmen2','total_abnormal2'));

        return view ('home', compact('bl', 'cl', 'gl', 'pl', 'segmen_normal', 'segmen_not_normal', 'seg_normal', 'seg_not_normal',
            'total_cluster_normal', 'platinum_normal', 'gold_normal', 'silver_normal', 'reguler_normal',
            'total_cluster_notnormal', 'platinum_not_normal', 'gold_not_normal', 'silver_not_normal', 'reguler_not_normal', 'unbill_not_normal',
            'total_cluster_indihome', 'indihome_2p', 'indihome_3p',
            'modem_off_percent', 'bill_off_percent', 'modemBill_off_percent', 'modem_off', 'bill_off', 'modemBill_off',
            'total_cluster_usageinet', 'usageInet1', 'usageInet2', 'usageInet3', 'usageInet4',
            'count_cluster_usia', 'totalcount_cluster_usia',
            'count_cluster_speed', 'total_cluster_speed'));
    }
}
