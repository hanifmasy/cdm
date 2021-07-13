<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SfGoproExport;
use App\Http\Controllers\Controller;
use App\Models\MasterDataTreg;
use App\Models\ReportSpeedInet;
use App\Models\Witel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel as Excel;

class ReportingCustomerController extends Controller
{
    public function arpu(Request $request)
    {      
        $arr_arpu_ct0 = [];
        $arr_arpu_isiska = [];
        $arr_arpu_ncx = [];

        if ($request->ajax()) {
            $query = MasterDataTreg::select(array(
                'source',
                DB::raw("SUM(CASE WHEN revenue_trems = '0' THEN 1 ELSE 0 END) as a_null"),
                DB::raw("SUM(CASE WHEN revenue_trems > '0' AND revenue_trems <= '100000' THEN 1 ELSE 0 END) as b_0_100rb"),
                DB::raw("SUM(CASE WHEN revenue_trems > '100000' AND revenue_trems <= '200000' THEN 1 ELSE 0 END) as c_100_200rb"),
                DB::raw("SUM(CASE WHEN revenue_trems > '200000' AND revenue_trems <= '300000' THEN 1 ELSE 0 END) as d_200_300rb"),
                DB::raw("SUM(CASE WHEN revenue_trems > '300000' AND revenue_trems <= '500000' THEN 1 ELSE 0 END) as e_300_500rb"),            
                DB::raw("SUM(CASE WHEN revenue_trems > '500000' AND revenue_trems <= '1000000' THEN 1 ELSE 0 END) as f_500_1jt"),
                DB::raw("SUM(CASE WHEN revenue_trems > '1000000' THEN 1 ELSE 0 END) as g_lebihdari1jt"),                
            ))->whereIn('root_status', ['Active', 'Suspended'])->where('cprod', '11')->where('linecats_item_id', '<', '400');

            if ($request->witel != '') {
                $table = $query->where('witel_str', $request->witel);
                $query = $query->where('witel_str', $request->witel);
            } else {
                $table = $query;
                $query = $query;
            }
           
            $query = $query->groupBy('source')->get();            

            foreach ($query as $val) {
                if ($val->source == "CT0") {                    
                    array_push($arr_arpu_ct0, json_encode((int)$val->a_null));   
                    array_push($arr_arpu_ct0, json_encode((int)$val->b_0_100rb));   
                    array_push($arr_arpu_ct0, json_encode((int)$val->c_100_200rb));   
                    array_push($arr_arpu_ct0, json_encode((int)$val->d_200_300rb));   
                    array_push($arr_arpu_ct0, json_encode((int)$val->e_300_500rb));            
                    array_push($arr_arpu_ct0, json_encode((int)$val->f_500_1jt));   
                    array_push($arr_arpu_ct0, json_encode((int)$val->g_lebihdari1jt));   
                } else if ($val->source == "ISISKA") {             
                    array_push($arr_arpu_isiska, json_encode((int)$val->a_null));   
                    array_push($arr_arpu_isiska, json_encode((int)$val->b_0_100rb));   
                    array_push($arr_arpu_isiska, json_encode((int)$val->c_100_200rb));   
                    array_push($arr_arpu_isiska, json_encode((int)$val->d_200_300rb));   
                    array_push($arr_arpu_isiska, json_encode((int)$val->e_300_500rb));            
                    array_push($arr_arpu_isiska, json_encode((int)$val->f_500_1jt));   
                    array_push($arr_arpu_isiska, json_encode((int)$val->g_lebihdari1jt));
                } else if ($val->source == "NCX") {
                    array_push($arr_arpu_ncx, json_encode((int)$val->a_null));   
                    array_push($arr_arpu_ncx, json_encode((int)$val->b_0_100rb));   
                    array_push($arr_arpu_ncx, json_encode((int)$val->c_100_200rb));   
                    array_push($arr_arpu_ncx, json_encode((int)$val->d_200_300rb));   
                    array_push($arr_arpu_ncx, json_encode((int)$val->e_300_500rb));            
                    array_push($arr_arpu_ncx, json_encode((int)$val->f_500_1jt));   
                    array_push($arr_arpu_ncx, json_encode((int)$val->g_lebihdari1jt));
                }
            }            
            
            $total_arr_arpu = array();
            for ($i = 0, $length = count($arr_arpu_ct0); $i < $length; $i++){
                $total_arr_arpu[$i] = $arr_arpu_ct0[$i];
                $total_arr_arpu[$i] += $arr_arpu_isiska[$i];
                $total_arr_arpu[$i] += $arr_arpu_ncx[$i];  
            }            

            $total_all_arpu = array_sum($total_arr_arpu);
            $total_arrs_arpu = implode(',', $total_arr_arpu); 

            $arr_grand_total = [];
            $arr = [            
                'source' => "Grand Total",
                'a_null' => $total_arr_arpu[0],
                'b_0_100rb' => $total_arr_arpu[1],
                'c_100_200rb' => $total_arr_arpu[2],
                'd_200_300rb' => $total_arr_arpu[3],
                'e_300_500rb' => $total_arr_arpu[4],
                'f_500_1jt' => $total_arr_arpu[5],
                'g_lebihdari1jt' => $total_arr_arpu[6],
            ];
            array_push($arr_grand_total, $arr);

            $arr_arpu_ct0 = implode(',', $arr_arpu_ct0);
            $arr_arpu_isiska = implode(',', $arr_arpu_isiska);
            $arr_arpu_ncx = implode(',', $arr_arpu_ncx);
             
            $table = $table->get()->toArray();
            $arr_datatable_merge = array_merge($table, $arr_grand_total);            

            $data = [                
                'total_arpu_ct0' => '['.$arr_arpu_ct0.']',
                'total_arpu_isiska' => '['.$arr_arpu_isiska.']',
                'total_arpu_ncx' => '['.$arr_arpu_ncx.']',
                'total_arpu' => '['.$total_arrs_arpu.']',
                'total_all_arpu' => $total_all_arpu,
                'datatable' => $arr_datatable_merge,
            ];

            return response()->json($data);
        }

        $witels = Witel::get(['id', 'nama_witel']);

        return view ('admin.reportCustomer.arpu.index', compact('witels'));
    }

    public function mig2p3p(Request $request)
    {
        $arr_mig_2p = [];
        $arr_mig_3p = [];

        if ($request->ajax()) {
            $query = MasterDataTreg::select(array(
                '1p_2p_3p as mig2p3p',
                DB::raw("SUM(CASE WHEN revenue_trems = '0' THEN 1 ELSE 0 END) as a_null"),
                DB::raw("SUM(CASE WHEN revenue_trems > '0' AND revenue_trems <= '100000' THEN 1 ELSE 0 END) as b_0_100rb"),
                DB::raw("SUM(CASE WHEN revenue_trems > '100000' AND revenue_trems <= '200000' THEN 1 ELSE 0 END) as c_100_200rb"),
                DB::raw("SUM(CASE WHEN revenue_trems > '200000' AND revenue_trems <= '300000' THEN 1 ELSE 0 END) as d_200_300rb"),
                DB::raw("SUM(CASE WHEN revenue_trems > '300000' AND revenue_trems <= '500000' THEN 1 ELSE 0 END) as e_300_500rb"),            
                DB::raw("SUM(CASE WHEN revenue_trems > '500000' AND revenue_trems <= '1000000' THEN 1 ELSE 0 END) as f_500_1jt"),
                DB::raw("SUM(CASE WHEN revenue_trems > '1000000' THEN 1 ELSE 0 END) as g_lebihdari1jt"),                
            ))->whereIn('root_status', ['Active', 'Suspended'])->where('cprod', '11')->where('linecats_item_id', '<', '400');

            if ($request->witel != '') {
                $table = $query->where('witel_str', $request->witel);
                $query = $query->where('witel_str', $request->witel);
            } else {
                $table = $query;
                $query = $query;
            }

            $query = $query->groupBy('mig2p3p')->get();
            
            foreach ($query as $val) {
                if ($val->mig2p3p == "2P") {                    
                    array_push($arr_mig_2p, json_encode((int)$val->a_null));   
                    array_push($arr_mig_2p, json_encode((int)$val->b_0_100rb));   
                    array_push($arr_mig_2p, json_encode((int)$val->c_100_200rb));   
                    array_push($arr_mig_2p, json_encode((int)$val->d_200_300rb));   
                    array_push($arr_mig_2p, json_encode((int)$val->e_300_500rb));            
                    array_push($arr_mig_2p, json_encode((int)$val->f_500_1jt));   
                    array_push($arr_mig_2p, json_encode((int)$val->g_lebihdari1jt));   
                } else if ($val->mig2p3p == "3P") {             
                    array_push($arr_mig_3p, json_encode((int)$val->a_null));   
                    array_push($arr_mig_3p, json_encode((int)$val->b_0_100rb));   
                    array_push($arr_mig_3p, json_encode((int)$val->c_100_200rb));   
                    array_push($arr_mig_3p, json_encode((int)$val->d_200_300rb));   
                    array_push($arr_mig_3p, json_encode((int)$val->e_300_500rb));            
                    array_push($arr_mig_3p, json_encode((int)$val->f_500_1jt));   
                    array_push($arr_mig_3p, json_encode((int)$val->g_lebihdari1jt));
                } 
            } 

            $arr_2p[] = array_sum($arr_mig_2p);
            $arr_3p[] = array_sum($arr_mig_3p);
            $array_merge = array_merge($arr_2p, $arr_3p);
            $total_arr_merge = implode(',', $array_merge);             

            $total_arr_mig = array();
            for ($i = 0, $length = count($arr_mig_2p); $i < $length; $i++){
                $total_arr_mig[$i] = $arr_mig_2p[$i];
                $total_arr_mig[$i] += $arr_mig_3p[$i];                
            }             
            
            $total_all_mig = array_sum($total_arr_mig);
            $total_arrs_mig = implode(',', $total_arr_mig); 

            $arr_grand_total = [];
            $arr = [            
                'mig2p3p' => "Grand Total",
                'a_null' => $total_arr_mig[0],
                'b_0_100rb' => $total_arr_mig[1],
                'c_100_200rb' => $total_arr_mig[2],
                'd_200_300rb' => $total_arr_mig[3],
                'e_300_500rb' => $total_arr_mig[4],
                'f_500_1jt' => $total_arr_mig[5],
                'g_lebihdari1jt' => $total_arr_mig[6],
            ];
            array_push($arr_grand_total, $arr);                 
             
            $table = $table->get()->toArray();
            $arr_datatable_merge = array_merge($table, $arr_grand_total);   
            
            $data = [                                
                'total_mig' => '['.$total_arr_merge.']',
                'total_all_mig' => $total_all_mig,
                'datatable' => $arr_datatable_merge
            ];

            return response()->json($data);
        }

        $witels = Witel::get(['id', 'nama_witel']);
        
        return view ('admin.reportCustomer.mig.index', compact('witels'));
    }

    public function speed(Request $request)
    {   
        $arr_label_datel = [];
        $arr_speed_kurang10mbps = [];
        $arr_speed_lebih10mbps = [];  
               
        if ($request->ajax()) {
            $datels = MasterDataTreg::select('datel_str');

            $query = ReportSpeedInet::select(array(
                'cluster_speed',
                DB::raw("SUM(CASE WHEN datel_str = 'BALIKPAPAN' THEN 1 ELSE 0 END) as BALIKPAPAN"),
                DB::raw("SUM(CASE WHEN datel_str = 'BANJARBARU' THEN 1 ELSE 0 END) as BANJARBARU"),
                DB::raw("SUM(CASE WHEN datel_str = 'BANJARMASIN' THEN 1 ELSE 0 END) as BANJARMASIN"),
                DB::raw("SUM(CASE WHEN datel_str = 'BATU LICIN' THEN 1 ELSE 0 END) as BATULICIN"),
                DB::raw("SUM(CASE WHEN datel_str = 'BONTANG' THEN 1 ELSE 0 END) as BONTANG"),            
                DB::raw("SUM(CASE WHEN datel_str = 'BULUNGAN BERAU' THEN 1 ELSE 0 END) as BULUNGANBERAU"),
                DB::raw("SUM(CASE WHEN datel_str = 'KETAPANG' THEN 1 ELSE 0 END) as KETAPANG"),  
                DB::raw("SUM(CASE WHEN datel_str = 'MEMPAWAH' THEN 1 ELSE 0 END) as MEMPAWAH"),  
                DB::raw("SUM(CASE WHEN datel_str = 'MUARATEWEH' THEN 1 ELSE 0 END) as MUARATEWEH"),  
                DB::raw("SUM(CASE WHEN datel_str = 'NUNUKAN' THEN 1 ELSE 0 END) as NUNUKAN"),  
                DB::raw("SUM(CASE WHEN datel_str = 'PALANGKARAYA' THEN 1 ELSE 0 END) as PALANGKARAYA"),   
                DB::raw("SUM(CASE WHEN datel_str = 'PANGKALAN BUN' THEN 1 ELSE 0 END) as PANGKALANBUN"),   
                DB::raw("SUM(CASE WHEN datel_str = 'PONTIANAK' THEN 1 ELSE 0 END) as PONTIANAK"),   
                DB::raw("SUM(CASE WHEN datel_str = 'SAMARINDA' THEN 1 ELSE 0 END) as SAMARINDA"),                
                DB::raw("SUM(CASE WHEN datel_str = 'SAMPIT' THEN 1 ELSE 0 END) as SAMPIT"),
                DB::raw("SUM(CASE WHEN datel_str = 'SANGGAU' THEN 1 ELSE 0 END) as SANGGAU"),
                DB::raw("SUM(CASE WHEN datel_str = 'SINGKAWANG' THEN 1 ELSE 0 END) as SINGKAWANG"),
                DB::raw("SUM(CASE WHEN datel_str = 'SINTANG' THEN 1 ELSE 0 END) as SINTANG"),            
                DB::raw("SUM(CASE WHEN datel_str = 'TANAHGROGOT' THEN 1 ELSE 0 END) as TANAHGROGOT"),
                DB::raw("SUM(CASE WHEN datel_str = 'TANJUNG TABALONG' THEN 1 ELSE 0 END) as TANJUNGTABALONG"),  
                DB::raw("SUM(CASE WHEN datel_str = 'TARAKAN' THEN 1 ELSE 0 END) as TARAKAN"),  
                DB::raw("SUM(CASE WHEN datel_str = 'TENGGARONG' THEN 1 ELSE 0 END) as TENGGARONG"),                  
            ))->where('cluster_speed', '!=', null);

            $table = MasterDataTreg::select(array( 
                'datel_str',               
                DB::raw("SUM(CASE WHEN speed_pcrf is null THEN 1 ELSE 0 END) as a_blank"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '512' THEN 1 ELSE 0 END) as b_512"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '1024' THEN 1 ELSE 0 END) as c_1024"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '2048' THEN 1 ELSE 0 END) as d_2048"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '3072' THEN 1 ELSE 0 END) as e_3072"),            
                DB::raw("SUM(CASE WHEN speed_pcrf = '5120' THEN 1 ELSE 0 END) as f_5120"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '10240' THEN 1 ELSE 0 END) as g_10240"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '20480' THEN 1 ELSE 0 END) as h_20480"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '30720' THEN 1 ELSE 0 END) as i_30720"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '40960' THEN 1 ELSE 0 END) as j_40960"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '51200' THEN 1 ELSE 0 END) as k_51200"),   
                DB::raw("SUM(CASE WHEN speed_pcrf = '102400' THEN 1 ELSE 0 END) as l_102400"),   
                DB::raw("SUM(CASE WHEN speed_pcrf = '204800' THEN 1 ELSE 0 END) as m_204800"),   
                DB::raw("SUM(CASE WHEN speed_pcrf = '307200' THEN 1 ELSE 0 END) as n_307200"),              
            ))->whereIn('root_status', ['Active', 'Suspended'])->where('cprod', '11')->where('linecats_item_id', '<', '400');
            
            $total = MasterDataTreg::select(array(                        
                DB::raw("SUM(CASE WHEN speed_pcrf is null THEN 1 ELSE 0 END) as a_blank"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '512' THEN 1 ELSE 0 END) as b_512"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '1024' THEN 1 ELSE 0 END) as c_1024"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '2048' THEN 1 ELSE 0 END) as d_2048"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '3072' THEN 1 ELSE 0 END) as e_3072"),            
                DB::raw("SUM(CASE WHEN speed_pcrf = '5120' THEN 1 ELSE 0 END) as f_5120"),
                DB::raw("SUM(CASE WHEN speed_pcrf = '10240' THEN 1 ELSE 0 END) as g_10240"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '20480' THEN 1 ELSE 0 END) as h_20480"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '30720' THEN 1 ELSE 0 END) as i_30720"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '40960' THEN 1 ELSE 0 END) as j_40960"),  
                DB::raw("SUM(CASE WHEN speed_pcrf = '51200' THEN 1 ELSE 0 END) as k_51200"),   
                DB::raw("SUM(CASE WHEN speed_pcrf = '102400' THEN 1 ELSE 0 END) as l_102400"),   
                DB::raw("SUM(CASE WHEN speed_pcrf = '204800' THEN 1 ELSE 0 END) as m_204800"),   
                DB::raw("SUM(CASE WHEN speed_pcrf = '307200' THEN 1 ELSE 0 END) as n_307200"),              
            ))->whereIn('root_status', ['Active', 'Suspended'])->where('cprod', '11')->where('linecats_item_id', '<', '400');
                
            if ($request->witel != '') {
                $datels = $datels->where('witel_str', $request->witel);
                $table = $table->where('witel_str', $request->witel);
                $query = $query->where('witel_str', $request->witel);
                $total = $total->where('witel_str', $request->witel);
                
            }                

            $datels = $datels->groupBy('datel_str')->pluck('datel_str');
            $query = $query->groupBy('cluster_speed')->get();
            $table = $table->groupBy('datel_str');           
            $total = $total->get(); 
            
            if ($request->witel != '') {
                foreach ($query as $val) {                    
                    if ($request->witel == "BALIKPAPAN") {                    
                        if ($val->cluster_speed == "kurang10mbps") {
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->balikpapan));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->tanahgrogot));                
                        } else {
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->balikpapan));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->tanahgrogot));                
                        }
                    } else if ($request->witel == "KALBAR") {
                        if ($val->cluster_speed == "kurang10mbps") {
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->ketapang));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->mempawah));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->pontianak));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->sanggau));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->singkawang));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->sintang));                
                        } else {
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->ketapang));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->mempawah));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->pontianak));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->sanggau));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->singkawang));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->sintang));                 
                        }
                    } else if ($request->witel == "KALSEL") {
                        if ($val->cluster_speed == "kurang10mbps") {
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->banjarbaru));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->banjarmasin));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->batulicin));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->tanjungtabalong));                                                         
                        } else {
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->banjarbaru));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->banjarmasin));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->batulicin));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->tanjungtabalong));                                                          
                        }
                    } else if ($request->witel == "KALTARA") {
                        if ($val->cluster_speed == "kurang10mbps") {
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->bulunganberau));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->nunukan));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->tarakan));                                            
                        } else {
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->bulunganberau));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->nunukan));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->tarakan));                                            
                        }
                    } else if ($request->witel == "KALTENG") {
                        if ($val->cluster_speed == "kurang10mbps") {
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->muarateweh));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->palangkaraya));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->pangkalanbun));   
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->sampit));                                                                                     
                        } else {
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->muarateweh));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->palangkaraya));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->pangkalanbun));
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->sampit));                                            
                        }  
                    } else if ($request->witel == "SAMARINDA") {
                        if ($val->cluster_speed == "kurang10mbps") {
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->bontang));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->samarinda));                
                            array_push($arr_speed_kurang10mbps, json_encode((int)$val->tenggarong));                               
                        } else {
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->bontang));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->samarinda));                
                            array_push($arr_speed_lebih10mbps, json_encode((int)$val->tenggarong));                            
                        }  
                    }         
                }
            } else {
                foreach ($query as $val) {
                    if ($val->cluster_speed == "kurang10mbps") {                    
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->balikpapan));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->banjarbaru));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->banjarmasin));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->batulicin));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->bontang));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->bulunganberau));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->ketapang));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->mempawah));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->muarateweh));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->nunukan));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->palangkaraya));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->pangkalanbun));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->pontianak));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->samarinda));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->sampit));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->sanggau));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->singkawang));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->sintang));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->tanahgrogot));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->tanjungtabalong));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->tarakan));                
                        array_push($arr_speed_kurang10mbps, json_encode((int)$val->tenggarong));                       
                    } else if ($val->cluster_speed == "lebih10mbps") {
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->balikpapan));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->banjarbaru));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->banjarmasin));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->batulicin));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->bontang));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->bulunganberau));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->ketapang));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->mempawah));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->muarateweh));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->nunukan));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->palangkaraya));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->pangkalanbun));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->pontianak));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->samarinda));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->sampit));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->sanggau));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->singkawang));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->sintang));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->tanahgrogot));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->tanjungtabalong));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->tarakan));                
                        array_push($arr_speed_lebih10mbps, json_encode((int)$val->tenggarong));                       
                    }               
                }
            }
                        
            $total_arr_speed = array();
            for ($i = 0, $length = count($arr_speed_kurang10mbps); $i < $length; $i++){
                $total_arr_speed[$i] = $arr_speed_kurang10mbps[$i];
                $total_arr_speed[$i] += $arr_speed_lebih10mbps[$i];                 
            }            

            $total_all_speed = array_sum($total_arr_speed);
            $total_arrs_speed = implode(',', $total_arr_speed); 

            $arr_total_speed = [];
            foreach ($total as $val) {
                array_push($arr_total_speed, json_encode((int)$val->a_blank));   
                array_push($arr_total_speed, json_encode((int)$val->b_512));   
                array_push($arr_total_speed, json_encode((int)$val->c_1024));   
                array_push($arr_total_speed, json_encode((int)$val->d_2048));   
                array_push($arr_total_speed, json_encode((int)$val->e_3072));            
                array_push($arr_total_speed, json_encode((int)$val->f_5120));   
                array_push($arr_total_speed, json_encode((int)$val->g_10240));
                array_push($arr_total_speed, json_encode((int)$val->h_20480));
                array_push($arr_total_speed, json_encode((int)$val->i_30720));
                array_push($arr_total_speed, json_encode((int)$val->j_40960));
                array_push($arr_total_speed, json_encode((int)$val->k_51200));
                array_push($arr_total_speed, json_encode((int)$val->l_102400));
                array_push($arr_total_speed, json_encode((int)$val->m_204800));
                array_push($arr_total_speed, json_encode((int)$val->n_307200));
            }
            
            $arr_grand_total = [];
            $arr = [            
                "datel_str" => "GRAND TOTAL",
                "a_blank" => $arr_total_speed[0],
                "b_512" => $arr_total_speed[1],
                "c_1024" => $arr_total_speed[2],
                "d_2048" => $arr_total_speed[3],
                "e_3072" => $arr_total_speed[4],
                "f_5120" => $arr_total_speed[5],
                "g_10240" => $arr_total_speed[6],
                "h_20480" => $arr_total_speed[7],
                "i_30720" => $arr_total_speed[8],
                "j_40960" => $arr_total_speed[9],
                "k_51200" => $arr_total_speed[10],
                "l_102400" => $arr_total_speed[11],
                "m_204800" => $arr_total_speed[12],
                "n_307200" => $arr_total_speed[13],
            ];
            array_push($arr_grand_total, $arr);            

            foreach($datels as $datel)
            {
                array_push($arr_label_datel, json_encode((string)$datel));
            }
            $arr_label_datel = implode(', ', $arr_label_datel);             
           
            $arr_speed_kurang10mbps = implode(',', $arr_speed_kurang10mbps);
            $arr_speed_lebih10mbps = implode(',', $arr_speed_lebih10mbps);  
            
            $table = $table->get()->toArray();            
            $arr_datatable_merge = array_merge($table, $arr_grand_total); 

            $data = [   
                'labels_datel' => '['.$arr_label_datel.']',          
                'total_speed_kurang10mbps' => '['.$arr_speed_kurang10mbps.']',
                'total_speed_lebih10mbps' => '['.$arr_speed_lebih10mbps.']',
                'total_speed' => '['.$total_arrs_speed.']',
                'datatable' => $arr_datatable_merge
            ];

            return response()->json($data);
        }

        $witels = Witel::get(['id', 'nama_witel']);
        
        return view ('admin.reportCustomer.speed.index', compact('witels'));
    }

    public function speed_detail($datel, $speed_pcrf, Request $request){
        if($request->ajax()){
            $data = DB::connection('pg7')->table('smartprofile');
            if($speed_pcrf == "(blank)"){
                $data->select('notel','nd_reference','plblcl_trems','nama_gabungan','revenue_trems','rev_trems_ncli','speed_inet','kuota_speed_ncx', 'usage_inet_current_month','usage_inet_last_month','alpro_rxpoweronu')
                    ->where('datel_str', $datel)
                    ->where('speed_pcrf', NULL);
            }
            else {
                $data->select('notel','nd_reference','plblcl_trems','nama_gabungan','revenue_trems','rev_trems_ncli','speed_inet','kuota_speed_ncx', 'usage_inet_current_month','usage_inet_last_month','alpro_rxpoweronu')
                    ->where('datel_str', $datel)
                    ->where('speed_pcrf', $speed_pcrf);
            }
            $data->whereIn('root_status', ['Active', 'Suspended'])->where('cprod', '11')->where('linecats_item_id', '<', '400')->get();
            $table = DataTables::of($data);
            $table->addIndexColumn();
            $table->editColumn('notel', function ($row) {
                return $row->notel ? $row->notel : "";
            });
            $table->editColumn('nd_reference', function ($row) {
                return $row->nd_reference ? $row->nd_reference : "";
            });
            $table->editColumn('plblcl_trems', function ($row) {
                return $row->plblcl_trems ? $row->plblcl_trems : "";
            });
            $table->editColumn('nama_gabungan', function ($row) {
                return $row->nama_gabungan ? $row->nama_gabungan : "";
            });
            $table->editColumn('revenue_trems', function ($row) {
                return $row->revenue_trems ? $row->revenue_trems : "";
            });
            $table->editColumn('rev_trems_ncli', function ($row) {
                return $row->rev_trems_ncli ? $row->rev_trems_ncli : "";
            });
            $table->editColumn('speed_inet', function ($row) {
                return $row->speed_inet ? $row->speed_inet : "";
            });
            $table->editColumn('kuota_speed_ncx', function ($row) {
                return $row->kuota_speed_ncx ? $row->kuota_speed_ncx : "";
            });
            $table->editColumn('usage_inet_current_month', function ($row) {
                return $row->usage_inet_current_month ? $row->usage_inet_current_month : "";
            });
            $table->editColumn('usage_inet_last_month', function ($row) {
                return $row->usage_inet_last_month ? $row->usage_inet_last_month : "";
            });
            $table->editColumn('alpro_rxpoweronu', function ($row) {
                return $row->alpro_rxpoweronu ? $row->alpro_rxpoweronu : "";
            });
            return $table->make(true);
        }

        return view ('admin.reportCustomer.speed.detail');
    }

    public function pscabut(Request $request)
    {        
        $arr_labels_all = [];
        $arr_labels_date_all = [];
        $arr_counts_all = [];
    
        $arr_counts_caps = [];
        $arr_counts_cleansing = [];
        $arr_counts_cman = [];

        $date_now = Carbon::now()->toDateString();
        $date_one_year = date('Y-m-d', strtotime('-1 years + 1 month'));

        $periode_now = date('Ym');
        // $periode_now = "202103";

        if ($request->ajax()) {
            $target_caps = DB::connection('pg9')->table('target_churn_2021')
            ->select(
                "trans", 'bulan',
                DB::raw("sum(target) as count")
            )
            ->where("trans", 'CAPS')
            ->where("ubis", 'CONS');

            $target_cleansing = DB::connection('pg9')->table('target_churn_2021')
            ->select(
                "trans", 'bulan',
                DB::raw("sum(target) as count")
            )
            ->where("trans", 'CLEANSING')
            ->where("ubis", 'CONS');

            $target_lis = DB::connection('pg9')->table('target_churn_2021')
            ->select(
                "trans", 'bulan',
                DB::raw("sum(target) as count")
            )
            ->where("trans", 'LIS')
            ->where("ubis", 'CONS');

            $query_all = DB::connection('pg9')->table('cabut_2p_gabungan_3p')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"), 
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"), 
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut');

            $query_caps = DB::connection('pg9')->table('caps')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut');

            $query_cleansing = DB::connection('pg9')->table('cleansing')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut');   
                
            $query_cman = DB::connection('pg9')->table('cman')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut');   

            $query_caps2 = DB::connection('pg9')->table('caps')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut');

            // $query_caps_witel = DB::connection('pg9')->table('caps')          
            //     ->select(
            //         'c_witel',
            //         DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
            //         DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
            //         DB::raw("((count(DISTINCT ndem))) as count")
            //     )
            //     ->whereNotNull('tgl_pscabut');

            $query_cleansing2 = DB::connection('pg9')->table('cleansing')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut');   
                
            $query_cman2 = DB::connection('pg9')->table('cman')          
                ->select(
                    DB::raw("(TO_CHAR(tgl_pscabut, 'Mon YYYY')) as pscabut_date"),   
                    DB::raw("(TO_CHAR(tgl_pscabut, 'YYYYMM')) as pscabut"),                   
                    DB::raw("((count(DISTINCT ndem))) as count")
                )
                ->whereNotNull('tgl_pscabut'); 

            $query_lis202101 = Cache::get('lis202101');
            $query_lis202102 = Cache::get('lis202102');
            $query_lis202103 = Cache::get('countPersonal')->count;
            
            if ($request->witel != '') {                
                $query_all = $query_all->where('c_witel', $request->witel);
                $query_caps = $query_caps->where('c_witel', $request->witel);
                $query_cleansing = $query_cleansing->where('c_witel', $request->witel);
                $query_cman = $query_cman->where('c_witel', $request->witel);
            } 

            if ($request->start_ps != '' && $request->end_ps != '') {
                $query_all = $query_all->whereBetween('tgl_pscabut', [$request->start_ps, $request->end_ps]);
                $query_caps = $query_caps->whereBetween('tgl_pscabut', [$request->start_ps, $request->end_ps]);
                $query_cleansing = $query_cleansing->whereBetween('tgl_pscabut', [$request->start_ps, $request->end_ps]);
                $query_cman = $query_cman->whereBetween('tgl_pscabut', [$request->start_ps, $request->end_ps]);

                // $query_all = $query_all->whereDate('tgl_pscabut', '>=', $request->start_ps)->whereDate('tgl_pscabut', '<=', $request->end_ps);
                // $query_caps = $query_caps->whereDate('tgl_pscabut', '>=', $request->start_ps)->whereDate('tgl_pscabut', '<=', $request->end_ps);
                // $query_cleansing = $query_cleansing->whereDate('tgl_pscabut', '>=', $request->start_ps)->whereDate('tgl_pscabut', '<=', $request->end_ps);
                
            } else {
                $query_all = $query_all->whereBetween('tgl_pscabut', [$date_one_year, $date_now]);
                $query_caps = $query_caps->whereBetween('tgl_pscabut', [$date_one_year, $date_now]);
                $query_cleansing = $query_cleansing->whereBetween('tgl_pscabut', [$date_one_year, $date_now]);
                $query_cman = $query_cman->whereBetween('tgl_pscabut', [$date_one_year, $date_now]);

                // $query_all = $query_all->whereDate('tgl_pscabut', '>=', date($date_one_year))->whereDate('tgl_pscabut', '<=', date($date_now));
                // $query_caps = $query_caps->whereDate('tgl_pscabut', '>=', date($date_one_year))->whereDate('tgl_pscabut', '<=', date($date_now));
                // $query_cleansing = $query_cleansing->whereDate('tgl_pscabut', '>=', date($date_one_year))->whereDate('tgl_pscabut', '<=', date($date_now));
            }

            $target_caps = $target_caps->groupBy('trans', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_cleansing = $target_cleansing->groupBy('trans', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_lis = $target_lis->groupBy('trans', 'bulan')->orderBy('bulan', 'desc')->get();
            
            // dd($target_lis);

            $query_all = $query_all->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();
            $query_caps = $query_caps->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();
            $query_cleansing = $query_cleansing->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();
            $query_cman = $query_cman->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();

            $query_caps2 = $query_caps2->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();
            // $query_caps_witel = $query_caps_witel->groupBy("c_witel", "pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();

            $query_cleansing2 = $query_cleansing2->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();
            $query_cman2 = $query_cman2->groupBy("pscabut","pscabut_date")->orderBy('pscabut', 'asc')->get();
            
            foreach ($query_all as $value) {
                array_push($arr_labels_all, $value->pscabut);
                array_push($arr_labels_date_all, '"'.$value->pscabut_date.'"');
                array_push($arr_counts_all, (int)$value->count);
            }

            foreach ($target_caps as $target_caps_val) {
                if ($request->periode != '') {
                    if ($target_caps_val->bulan == $request->periode) {
                        $target_caps = $target_caps_val->count; 
                    } 
                } else {
                    if ($target_caps_val->bulan == $periode_now) {
                        $target_caps = $target_caps_val->count; 
                    }  
                }
            } 
            
            foreach ($target_cleansing as $target_cleansing_val) {
                if ($request->periode != '') {
                    if ($target_cleansing_val->bulan == $request->periode) {
                        $target_cleansing = $target_cleansing_val->count; 
                    } 
                } else {
                    if ($target_cleansing_val->bulan == $periode_now) {
                        $target_cleansing = $target_cleansing_val->count; 
                    }  
                }
            } 

            foreach ($target_lis as $target_lis_val) {
                if ($request->periode != '') {
                    if ($target_lis_val->bulan == $request->periode) {
                        $target_lis = $target_lis_val->count; 
                    } 
                } else {
                    if ($target_lis_val->bulan == $periode_now) {
                        $target_lis = $target_lis_val->count; 
                    }  
                }
            } 

            foreach ($query_caps as $caps_val) {
                array_push($arr_counts_caps, (int)$caps_val->count);
            }

            foreach ($query_cleansing as $cleansing_val) {
                array_push($arr_counts_cleansing, (int)$cleansing_val->count);
            }

            foreach ($query_cman as $cman_val) {
                array_push($arr_counts_cman, (int)$cman_val->count);
            }

            foreach ($query_caps2 as $caps_val) {                               
                if ($request->periode != '') {
                    if ($caps_val->pscabut == $request->periode) {
                        $caps = $caps_val->count; 
                    } 
                } else {
                    if ($caps_val->pscabut == $periode_now) {
                        $caps = $caps_val->count; 
                    } 
                }
            }

            foreach ($query_cleansing2 as $cleansing_val) {                               
                if ($request->periode != '') {
                    if ($cleansing_val->pscabut == $request->periode) {
                        $cleansing = $cleansing_val->count; 
                    } 
                } else {
                    if ($cleansing_val->pscabut == $periode_now) {
                        $cleansing = $cleansing_val->count; 
                    } 
                }
            }

            foreach ($query_cman2 as $cman_val) {                               
                if ($request->periode != '') {
                    if ($cman_val->pscabut == $request->periode) {
                        $cman = $cman_val->count; 
                    } 
                } else {
                    if ($cman_val->pscabut == $periode_now) {
                        $cman = $cman_val->count; 
                    } 
                }                
            }

            if (($request->periode != '') && ($request->periode != $periode_now) ) {
                if ($request->periode == '202101') {
                    $lis = $query_lis202101;
                } else if ($request->periode == '202102') {
                    $lis = $query_lis202102;
                }
            } else {
                $lis = $query_lis202103;
            }

            @$total_cleansing = $cleansing + $cman;
           
            @$ach_caps = round(($target_caps / $caps) * 100); 
            @$ach_cleansing = round(($target_cleansing / $total_cleansing) * 100); 
            @$ach_lis = round(($lis / $target_lis) * 100); 

            $arr_labels_all = implode(',', $arr_labels_all);
            $arr_labels_date_all = implode(',', $arr_labels_date_all);
            $arr_counts_all = implode(',', $arr_counts_all);

            $arr_counts_caps = implode(',', $arr_counts_caps);
            $arr_counts_cleansing = implode(',', $arr_counts_cleansing);
            $arr_counts_cman = implode(',', $arr_counts_cman);

            $data = [
                'target_caps' => $target_caps,
                'caps' => $caps,
                'ach_caps' => $ach_caps,
                'target_cleansing' => $target_cleansing,
                'cleansing' => $total_cleansing,
                'ach_cleansing' => $ach_cleansing,
                'target_lis' => $target_lis,
                'lis' => $lis,
                'ach_lis' => $ach_lis,
                'labels_pscabut' => '['.$arr_labels_all.']',
                'labels_date_pscabut' => '['.$arr_labels_date_all.']',
                'total_counts_pscabut' => '['.$arr_counts_all.']',
                'total_counts_caps' => '['.$arr_counts_caps.']',
                'total_counts_cleansing' => '['.$arr_counts_cleansing.']',
                'total_counts_cman' => '['.$arr_counts_cman.']'
            ];

            // dd($data);

            return response()->json($data);
        }

        $periodes = DB::connection('pg9')->table('target_churn_2021')
            ->select('bulan')->where('bulan', '<=', $periode_now)->orderBy('bulan', 'desc')->distinct()->get();

        return view('admin.reportCustomer.pscabut.index', compact('periodes'));
    }

    public function performaddon(Request $request)
    {
        $arr_labels_date = [];

        $arr_counts_mig2p3p = [];
        $arr_counts_minipack = [];
        $arr_counts_stb = [];
        $arr_counts_upgradespeed = [];

        $date_now = date('Y-m-d', strtotime('-1 day'));
        $month_now = Carbon::parse(Carbon::now())->format('F');
        
        $date_one_year = date('Y-m-d', strtotime('-1 years + 1 month'));
        $date_one_month_ago = date('Y-m-d', strtotime('-1 month'));

        if ($request->ajax()) {           

            $query_mig2p3p =  DB::connection('pg2')->table('ditcons_mig_2p3p_non_indibox')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(DISTINCT ndem))) as count")
            )
            ->whereNotNull('tgl_ps');

            $query_minipack =  DB::connection('pg2')->table('ditcons_minipack')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(DISTINCT ndem))) as count")
            )
            ->whereNotNull('tgl_ps');

            $query_stb =  DB::connection('pg2')->table('ditcons_stb_tambahan')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(DISTINCT ndem))) as count")
            )
            ->whereNotNull('tgl_ps');

            $query_upgradespeed =  DB::connection('pg2')->table('ditcons_upgradespeed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(DISTINCT ndem))) as count")
            )
            ->whereNotNull('tgl_ps');

            if ($request->witel != '') {
                $query_mig2p3p = $query_mig2p3p->where('c_witel', $request->witel);
                $query_minipack = $query_minipack->where('c_witel', $request->witel);
                $query_stb = $query_stb->where('c_witel', $request->witel);
                $query_upgradespeed = $query_upgradespeed->where('c_witel', $request->witel);
            } 

            if ($request->start_date != '' && $request->end_date != '') {
                $query_mig2p3p = $query_mig2p3p->whereBetween('tgl_ps', [$request->start_date, $request->end_date]);
                $query_minipack = $query_minipack->whereBetween('tgl_ps', [$request->start_date, $request->end_date]);
                $query_stb = $query_stb->whereBetween('tgl_ps', [$request->start_date, $request->end_date]);
                $query_upgradespeed = $query_upgradespeed->whereBetween('tgl_ps', [$request->start_date, $request->end_date]);
            } else {
                $query_mig2p3p = $query_mig2p3p->whereBetween('tgl_ps', [$date_one_year, $date_now]);
                $query_minipack = $query_minipack->whereBetween('tgl_ps', [$date_one_year, $date_now]);
                $query_stb = $query_stb->whereBetween('tgl_ps', [$date_one_year, $date_now]);
                $query_upgradespeed = $query_upgradespeed->whereBetween('tgl_ps', [$date_one_year, $date_now]);
            }

            $query_mig2p3p = $query_mig2p3p->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $query_minipack = $query_minipack->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $query_stb = $query_stb->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $query_upgradespeed = $query_upgradespeed->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
    
            foreach ($query_mig2p3p as $value) {
                array_push($arr_labels_date, '"'.$value->ps_date.'"');
                array_push($arr_counts_mig2p3p, (int)$value->count);
            }
    
            foreach ($query_minipack as $value) {            
                array_push($arr_counts_minipack, (int)$value->count);
            }
    
            foreach ($query_stb as $value) {            
                array_push($arr_counts_stb, (int)$value->count);
            }
    
            foreach ($query_upgradespeed as $value) {            
                array_push($arr_counts_upgradespeed, (int)$value->count);
            }

            $total_arr_addon = [];
            for ($i = 0, $length = count($arr_counts_mig2p3p); $i < $length; $i++){
                $total_arr_addon[$i] = $arr_counts_mig2p3p[$i];
                $total_arr_addon[$i] += $arr_counts_minipack[$i]; 
                $total_arr_addon[$i] += $arr_counts_stb[$i]; 
                $total_arr_addon[$i] += $arr_counts_upgradespeed[$i];                 
            }   

            $total_arrs_addon = implode(',', $total_arr_addon);             
    
            $arr_labels_date = implode(',', $arr_labels_date);
            $arr_counts_mig2p3p = implode(',', $arr_counts_mig2p3p);
            $arr_counts_minipack = implode(',', $arr_counts_minipack);
            $arr_counts_stb = implode(',', $arr_counts_stb);
            $arr_counts_upgradespeed = implode(',', $arr_counts_upgradespeed);
    
            $data = [
                'labels_date_ps' => '['.$arr_labels_date.']',
                'total_counts_mig2p3p' => '['.$arr_counts_mig2p3p.']',
                'total_counts_minipack' => '['.$arr_counts_minipack.']',
                'total_counts_stb' => '['.$arr_counts_stb.']',
                'total_counts_upgradespeed' => '['.$arr_counts_upgradespeed.']',
                'total_counts_all' => '['.$total_arrs_addon.']',              
            ];
    
            // dd($data);
    
            return response()->json($data);
        }

        return view ('admin.reportCustomer.performansiAddon.index', compact('month_now'));
    }

    public function sfgopro(Request $request)
    {           
        if ($request->ajax()) {
            $worst_sales = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                'channel', 'seller_id', 'nama_seller',
                DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                DB::raw("sum(1) as total_dapros"),
                ))
                ->whereNotNull('channel')
                ->whereNotNull('offer_type');

            $query = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                'channel',
                DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                DB::raw("sum(1) as total_dapros"),
                ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->whereNotNull('offer_type');

            $query_total = DB::connection('pg10')->table('dapros_status_fixed')->select(array(                
                DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                DB::raw("sum(1) as total_dapros"),
                ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->whereNotNull('offer_type');

            $minipack = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                    'channel',
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'minipack');
            
            $minipack_total = DB::connection('pg10')->table('dapros_status_fixed')->select(array(                    
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'minipack');

            $upgrade = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                    'channel',
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'upgrade_speed');

            $upgrade_total = DB::connection('pg10')->table('dapros_status_fixed')->select(array(                    
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'upgrade_speed');

            $stb = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                    'channel',
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'stb_tambahan');
            
            $stb_total = DB::connection('pg10')->table('dapros_status_fixed')->select(array(                    
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'stb_tambahan');

            $mig2p3p = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                    'channel',
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'mig2p3p');

            $mig2p3p_total = DB::connection('pg10')->table('dapros_status_fixed')->select(array(                    
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'mig2p3p');
            
            $other = DB::connection('pg10')->table('dapros_status_fixed')->select(array(
                    'channel',
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'other');

            $other_total = DB::connection('pg10')->table('dapros_status_fixed')->select(array(                    
                    DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END) as sisa_dapros"),
                    DB::raw("sum(CASE when followup_time is not null then 1 ELSE 0 END) as total_followup"),
                    DB::raw("sum(1) as total_dapros"),
                    ))
                ->whereNotNull('channel')
                ->whereNotNull('witel_str')
                ->where('offer_type', 'other');

            if ($request->witel != '') {                
                $worst_sales = $worst_sales->where('witel_str', $request->witel);                                
                $query = $query->where('witel_str', $request->witel);                                
                $query_total = $query_total->where('witel_str', $request->witel);                                
                $minipack = $minipack->where('witel_str', $request->witel); 
                $minipack_total = $minipack_total->where('witel_str', $request->witel); 
                $upgrade = $upgrade->where('witel_str', $request->witel); 
                $upgrade_total = $upgrade_total->where('witel_str', $request->witel); 
                $stb = $stb->where('witel_str', $request->witel); 
                $stb_total = $stb_total->where('witel_str', $request->witel); 
                $mig2p3p = $mig2p3p->where('witel_str', $request->witel); 
                $mig2p3p_total = $mig2p3p_total->where('witel_str', $request->witel); 
                $other = $other->where('witel_str', $request->witel); 
                $other_total = $other_total->where('witel_str', $request->witel); 
            } 

            if ($request->sales_channel != '') {
                $worst_sales = $worst_sales->where('channel', $request->sales_channel);
            } 

            $worst_sales = $worst_sales->groupBy('channel', 'seller_id', 'nama_seller')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->take(5);

            $query = $query->groupBy('channel')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->toArray();

            $query_total = $query_total->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->first();
            
            $minipack = $minipack->groupBy('channel')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->toArray();
            
            $minipack_total = $minipack_total->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->first();

            $upgrade = $upgrade->groupBy('channel')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->toArray();

            $upgrade_total = $upgrade_total->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->first();
            
            $stb = $stb->groupBy('channel')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->toArray();

            $stb_total = $stb_total->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->first();

            $mig2p3p = $mig2p3p->groupBy('channel')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->toArray();

            $mig2p3p_total = $mig2p3p_total->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->first();

            $other = $other->groupBy('channel')
                ->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->get()->toArray();

            $other_total = $other_total->orderBy(DB::raw("sum(CASE when followup_time is null then 1 ELSE 0 END)"),'DESC')
                ->first();

            $arr_total_query = [];
            $total_query = [
                'channel' => "ALL",
                'sisa_dapros' => $query_total->sisa_dapros,
                'total_followup' => $query_total->total_followup,
                'total_dapros' => $query_total->total_dapros,                
            ];
            array_push($arr_total_query, $total_query);
            $dt_query = array_merge($query, $arr_total_query);             

            $arr_total_minipack = [];
            $total_minipack = [
                'channel' => "ALL",
                'sisa_dapros' => $minipack_total->sisa_dapros,
                'total_followup' => $minipack_total->total_followup,
                'total_dapros' => $minipack_total->total_dapros,                
            ];
            array_push($arr_total_minipack, $total_minipack);
            $dt_minipack = array_merge($minipack, $arr_total_minipack);
            
            $arr_total_upgrade = [];
            $total_upgrade = [
                'channel' => "ALL",
                'sisa_dapros' => $upgrade_total->sisa_dapros,
                'total_followup' => $upgrade_total->total_followup,
                'total_dapros' => $upgrade_total->total_dapros,                
            ];
            array_push($arr_total_upgrade, $total_upgrade);
            $dt_upgrade = array_merge($upgrade, $arr_total_upgrade);

            $arr_total_stb = [];
            $total_stb = [
                'channel' => "ALL",
                'sisa_dapros' => $stb_total->sisa_dapros,
                'total_followup' => $stb_total->total_followup,
                'total_dapros' => $stb_total->total_dapros,                
            ];
            array_push($arr_total_stb, $total_stb);
            $dt_stb = array_merge($stb, $arr_total_stb);

            $arr_total_mig2p3p = [];
            $total_mig2p3p = [
                'channel' => "ALL",
                'sisa_dapros' => $mig2p3p_total->sisa_dapros,
                'total_followup' => $mig2p3p_total->total_followup,
                'total_dapros' => $mig2p3p_total->total_dapros,                
            ];
            array_push($arr_total_mig2p3p, $total_mig2p3p);
            $dt_mig2p3p = array_merge($mig2p3p, $arr_total_mig2p3p);

            $arr_total_other = [];
            $total_other = [
                'channel' => "ALL",
                'sisa_dapros' => $other_total->sisa_dapros,
                'total_followup' => $other_total->total_followup,
                'total_dapros' => $other_total->total_dapros,                
            ];
            array_push($arr_total_other, $total_other);
            $dt_other = array_merge($other, $arr_total_other);


            $data = [
                'total_worst_sales' => $worst_sales,
                'total_all_addon' => $dt_query,
                'total_minipack_addon' => $dt_minipack,
                'total_upgrade_addon' => $dt_upgrade,
                'total_stb_addon' => $dt_stb,
                'total_mig2p3p_addon' => $dt_mig2p3p,
                'total_other_addon' => $dt_other,
            ];

            return response()->json($data);
        }

        $witels = Witel::get(['id', 'nama_witel']);
        $channels = array('CSR', 'SF', 'SFAO', 'SFD', 'TAM', 'TEKNISI');
       
        return view ('admin.reportCustomer.sfgopro.index', compact('witels', 'channels'));
    }

    public function show_sfgopro($witel, $channel, $addon, $dapros, Request $request)
    {
        if ($request->ajax()) {
            $dt_query = DB::connection('pg10')->table('dapros_status_fixed')
            ->select(
                "seller_id", "name", "witel_str", "datel", "current_total_price", "current_package", 
                "usee_tv", "promo", "subscription_month", "created_at", "updated_time", "channel", 
                "offer_type", "followup_time", "nama_seller"
            )
            ->whereNotNull('channel')
            ->whereNotNull('witel_str')
            ->whereNotNull('offer_type');

            if ($witel == "ALL_WITEL") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('witel_str', $witel);
            }

            if ($channel == "ALL") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('channel', $channel);
            } 

            if ($addon == "ALL_ADDON") {
                $dt_query = $dt_query;
            } else {
                $dt_query = $dt_query->where('offer_type', $addon);
            }

            if ($dapros == "SISA_DAPROS") {
                $dt_query = $dt_query->whereNull('followup_time');
            } else if ($dapros == "FOLLOWUP_DAPROS") {
                $dt_query = $dt_query->whereNotNull('followup_time');
            } else {
                $dt_query = $dt_query;
            }

            $table = DataTables::of($dt_query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('seller_id', function ($row) {
                return $row->seller_id ? $row->seller_id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('witel_str', function ($row) {
                return $row->witel_str ? $row->witel_str : "";
            });
            $table->editColumn('datel', function ($row) {
                return $row->datel ? $row->datel : "";
            });
            $table->editColumn('current_total_price', function ($row) {
                return $row->current_total_price ? $row->current_total_price : "";
            });
            $table->editColumn('current_package', function ($row) {
                return $row->current_package ? $row->current_package : "";
            });
            $table->editColumn('usee_tv', function ($row) {
                return $row->usee_tv ? $row->usee_tv : "";
            });
            $table->editColumn('promo', function ($row) {
                return $row->promo ? $row->promo : "";
            });
            $table->editColumn('subscription_month', function ($row) {
                return $row->subscription_month ? $row->subscription_month : "";
            });
            $table->editColumn('channel', function ($row) {
                return $row->channel ? $row->channel : "";
            });
            $table->editColumn('offer_type', function ($row) {
                return $row->offer_type ? $row->offer_type : "";
            });          
            $table->editColumn('followup_time', function ($row) {
                return $row->followup_time ? $row->followup_time : "";
            });
            $table->editColumn('nama_seller', function ($row) {
                return $row->nama_seller ? $row->nama_seller : "";
            });   
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : "";
            });
            $table->editColumn('updated_time', function ($row) {
                return $row->updated_time ? $row->updated_time : "";
            });     
            
            $table->rawColumns(['placeholder']);

            return $table->make(true);  
        }

        return view ('admin.reportCustomer.sfgopro.show');
    }

    public function download_sfgopro($witel, $channel, $addon, $dapros, Request $request)
    {
        $request['witel'] = $witel;
        $request['channel'] = $channel;
        $request['addon'] = $addon;
        $request['dapros'] = $dapros;

        return Excel::download(new SfGoproExport($request->all()),'SF GoPro.xlsx');
    }

    public function achaddon(Request $request)
    {
        $periode_now = date('Ym');
        // $periode_now = "202102";
        // $request->periode = "202102";
        
        if ($request->ajax()) {

            // TARGET ADDON
            $target_mig2p3p = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MIGRASI 3P');

            $target_minipack = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MINIPACK');

            $target_stb = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'STB');

            $target_upgrade = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'UPGRADE SPEED');

            $target_mig1p2p = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MIGRASI 2P');

            $target_wifiext = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'WIFI EXT');

            $target_plc = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'PLC');

            $target_ottvideo = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'OTT VIDEO');

            $target_musik = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'MUSIK');

            $target_indibox = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'INDIBOX STB+APPS');

            $target_ihsmart = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'IH SMART');

            $target_ihstudy = DB::connection('pg2')->table('target_addon_2021')
            ->select(
                "product", 'bulan',
                DB::raw("sum(sales) as count")
            )
            ->where("product", 'IH STUDY');
            
            
            // DITCONS ADDON
            $minipack_psb =  DB::connection('pg2')->table('ditcons_minipack_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', '1');  

            $minipack_sales =  DB::connection('pg2')->table('ditcons_minipack_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', 'BB');

            $minipack_prepaid = DB::connection('pg2')->table('ditcons_minipack_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->whereNotIn('coper', ['BB','1']);
            
            $mig2p3p =  DB::connection('pg2')->table('ditcons_mig_2p3p_non_indibox_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1'); 

            $stb =  DB::connection('pg2')->table('ditcons_stb_tambahan_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');

            $upgrade =  DB::connection('pg2')->table('ditcons_upgradespeed_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');

            $mig1p2p =  DB::connection('pg2')->table('ditcons_mig_1p2p_homewifi_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');

            $wifiext =  DB::connection('pg2')->table('ditcons_mig_1p2p_homewifi_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');
            
            $plc =  DB::connection('pg2')->table('ditcons_plc_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');

            $ottvideo =  DB::connection('pg2')->table('ditcons_ott_video_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(*))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');

            $musik_psb =  DB::connection('pg2')->table('ditcons_musik_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', '1'); 

            $musik_sales =  DB::connection('pg2')->table('ditcons_musik_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', 'BB'); 

            $musik_prepaid =  DB::connection('pg2')->table('ditcons_musik_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->whereNotIn('coper', ['BB','1']);

            $indibox =  DB::connection('pg2')->table('ditcons_indibox_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1');

            $ihsmart_psb =  DB::connection('pg2')->table('ditcons_ihsmart_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', '1');   
            
            $ihsmart_sales =  DB::connection('pg2')->table('ditcons_ihsmart_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', 'BB'); 
            
            $ihsmart_prepaid =  DB::connection('pg2')->table('ditcons_ihsmart_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->whereNotIn('coper', ['BB','1']); 

            $ihstudy_psb =  DB::connection('pg2')->table('ditcons_ihstudy_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', '1'); 

            $ihstudy_sales =  DB::connection('pg2')->table('ditcons_ihstudy_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->where('coper', 'BB'); 

            $ihstudy_prepaid =  DB::connection('pg2')->table('ditcons_ihstudy_fixed')          
            ->select(
                DB::raw("(TO_CHAR(tgl_ps, 'Mon YYYY')) as ps_date"), 
                DB::raw("(TO_CHAR(tgl_ps, 'YYYYMM')) as ps"),                    
                DB::raw("((count(1))) as count")
            )
            ->whereNotNull('tgl_ps')
            ->where('psb', '1')
            ->whereNotIn('coper', ['BB','1']); 

            if ($request->witel != '') {
                if ($request->witel == "42") {
                    $target_minipack = $target_minipack->where('witel', 'KALBAR'); 
                    $target_mig2p3p = $target_mig2p3p->where('witel', 'KALBAR'); 
                    $target_stb = $target_stb->where('witel', 'KALBAR'); 
                    $target_upgrade = $target_upgrade->where('witel', 'KALBAR'); 
                    $target_mig1p2p = $target_mig1p2p->where('witel', 'KALBAR'); 
                    $target_wifiext = $target_wifiext->where('witel', 'KALBAR'); 
                    $target_plc = $target_plc->where('witel', 'KALBAR'); 
                    $target_ottvideo = $target_ottvideo->where('witel', 'KALBAR'); 
                    $target_musik = $target_musik->where('witel', 'KALBAR'); 
                    $target_indibox = $target_indibox->where('witel', 'KALBAR'); 
                    $target_ihsmart = $target_ihsmart->where('witel', 'KALBAR'); 
                    $target_ihstudy = $target_ihstudy->where('witel', 'KALBAR'); 
                } 
                if ($request->witel == "43") {
                    $target_minipack = $target_minipack->where('witel', 'KALTENG'); 
                    $target_mig2p3p = $target_mig2p3p->where('witel', 'KALTENG'); 
                    $target_stb = $target_stb->where('witel', 'KALTENG'); 
                    $target_upgrade = $target_upgrade->where('witel', 'KALTENG'); 
                    $target_mig1p2p = $target_mig1p2p->where('witel', 'KALTENG'); 
                    $target_wifiext = $target_wifiext->where('witel', 'KALTENG'); 
                    $target_plc = $target_plc->where('witel', 'KALTENG'); 
                    $target_ottvideo = $target_ottvideo->where('witel', 'KALTENG'); 
                    $target_musik = $target_musik->where('witel', 'KALTENG'); 
                    $target_indibox = $target_indibox->where('witel', 'KALTENG'); 
                    $target_ihsmart = $target_ihsmart->where('witel', 'KALTENG'); 
                    $target_ihstudy = $target_ihstudy->where('witel', 'KALTENG'); 
                } 
                if ($request->witel == "44") {
                    $target_minipack = $target_minipack->where('witel', 'KALSEL'); 
                    $target_mig2p3p = $target_mig2p3p->where('witel', 'KALSEL'); 
                    $target_stb = $target_stb->where('witel', 'KALSEL'); 
                    $target_upgrade = $target_upgrade->where('witel', 'KALSEL'); 
                    $target_mig1p2p = $target_mig1p2p->where('witel', 'KALSEL'); 
                    $target_wifiext = $target_wifiext->where('witel', 'KALSEL'); 
                    $target_plc = $target_plc->where('witel', 'KALSEL'); 
                    $target_ottvideo = $target_ottvideo->where('witel', 'KALSEL'); 
                    $target_musik = $target_musik->where('witel', 'KALSEL'); 
                    $target_indibox = $target_indibox->where('witel', 'KALSEL'); 
                    $target_ihsmart = $target_ihsmart->where('witel', 'KALSEL'); 
                    $target_ihstudy = $target_ihstudy->where('witel', 'KALSEL'); 
                } 
                if ($request->witel == "45") {
                    $target_minipack = $target_minipack->where('witel', 'BALIKPAPAN'); 
                    $target_mig2p3p = $target_mig2p3p->where('witel', 'BALIKPAPAN'); 
                    $target_stb = $target_stb->where('witel', 'BALIKPAPAN'); 
                    $target_upgrade = $target_upgrade->where('witel', 'BALIKPAPAN'); 
                    $target_mig1p2p = $target_mig1p2p->where('witel', 'BALIKPAPAN'); 
                    $target_wifiext = $target_wifiext->where('witel', 'BALIKPAPAN'); 
                    $target_plc = $target_plc->where('witel', 'BALIKPAPAN'); 
                    $target_ottvideo = $target_ottvideo->where('witel', 'BALIKPAPAN'); 
                    $target_musik = $target_musik->where('witel', 'BALIKPAPAN'); 
                    $target_indibox = $target_indibox->where('witel', 'BALIKPAPAN'); 
                    $target_ihsmart = $target_ihsmart->where('witel', 'BALIKPAPAN'); 
                    $target_ihstudy = $target_ihstudy->where('witel', 'BALIKPAPAN'); 
                } 
                if ($request->witel == "46") {
                    $target_minipack = $target_minipack->where('witel', 'SAMARINDA'); 
                    $target_mig2p3p = $target_mig2p3p->where('witel', 'SAMARINDA'); 
                    $target_stb = $target_stb->where('witel', 'SAMARINDA'); 
                    $target_upgrade = $target_upgrade->where('witel', 'SAMARINDA'); 
                    $target_mig1p2p = $target_mig1p2p->where('witel', 'SAMARINDA'); 
                    $target_wifiext = $target_wifiext->where('witel', 'SAMARINDA'); 
                    $target_plc = $target_plc->where('witel', 'SAMARINDA'); 
                    $target_ottvideo = $target_ottvideo->where('witel', 'SAMARINDA'); 
                    $target_musik = $target_musik->where('witel', 'SAMARINDA'); 
                    $target_indibox = $target_indibox->where('witel', 'SAMARINDA'); 
                    $target_ihsmart = $target_ihsmart->where('witel', 'SAMARINDA'); 
                    $target_ihstudy = $target_ihstudy->where('witel', 'SAMARINDA'); 
                } 
                if ($request->witel == "47") {
                    $target_minipack = $target_minipack->where('witel', 'KALTARA'); 
                    $target_mig2p3p = $target_mig2p3p->where('witel', 'KALTARA'); 
                    $target_stb = $target_stb->where('witel', 'KALTARA'); 
                    $target_upgrade = $target_upgrade->where('witel', 'KALTARA'); 
                    $target_mig1p2p = $target_mig1p2p->where('witel', 'KALTARA'); 
                    $target_wifiext = $target_wifiext->where('witel', 'KALTARA'); 
                    $target_plc = $target_plc->where('witel', 'KALTARA'); 
                    $target_ottvideo = $target_ottvideo->where('witel', 'KALTARA'); 
                    $target_musik = $target_musik->where('witel', 'KALTARA'); 
                    $target_indibox = $target_indibox->where('witel', 'KALTARA'); 
                    $target_ihsmart = $target_ihsmart->where('witel', 'KALTARA'); 
                    $target_ihstudy = $target_ihstudy->where('witel', 'KALTARA'); 
                } 
                $minipack_psb = $minipack_psb->where('c_witel', $request->witel);                                
                $minipack_sales = $minipack_sales->where('c_witel', $request->witel);                                
                $minipack_prepaid = $minipack_prepaid->where('c_witel', $request->witel);                                
                $mig2p3p = $mig2p3p->where('c_witel', $request->witel);   
                $stb = $stb->where('c_witel', $request->witel);  
                $upgrade = $upgrade->where('c_witel', $request->witel);  
                $mig1p2p = $mig1p2p->where('c_witel', $request->witel);  
                $wifiext = $wifiext->where('c_witel', $request->witel);  
                $plc = $plc->where('c_witel', $request->witel);  
                $ottvideo = $ottvideo->where('c_witel', $request->witel);  
                $musik_psb = $musik_psb->where('c_witel', $request->witel);  
                $musik_sales = $musik_sales->where('c_witel', $request->witel);  
                $musik_prepaid = $musik_prepaid->where('c_witel', $request->witel);  
                $indibox = $indibox->where('c_witel', $request->witel);
                $ihsmart_psb = $ihsmart_psb->where('c_witel', $request->witel);                
                $ihsmart_sales = $ihsmart_sales->where('c_witel', $request->witel);                
                $ihsmart_prepaid = $ihsmart_prepaid->where('c_witel', $request->witel);                
                $ihstudy_psb = $ihstudy_psb->where('c_witel', $request->witel);
                $ihstudy_sales = $ihstudy_sales->where('c_witel', $request->witel);
                $ihstudy_prepaid = $ihstudy_prepaid->where('c_witel', $request->witel);
            } 

            $target_minipack = $target_minipack->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_mig2p3p = $target_mig2p3p->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_stb = $target_stb->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_upgrade = $target_upgrade->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_mig1p2p = $target_mig1p2p->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_wifiext = $target_wifiext->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_plc = $target_plc->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_ottvideo = $target_ottvideo->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_musik = $target_musik->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_indibox = $target_indibox->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_ihsmart = $target_ihsmart->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();
            $target_ihstudy = $target_ihstudy->groupBy('product', 'bulan')->orderBy('bulan', 'desc')->get();

            $minipack_psb = $minipack_psb->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $minipack_sales = $minipack_sales->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $minipack_prepaid = $minipack_prepaid->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $mig2p3p = $mig2p3p->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $stb = $stb->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $upgrade = $upgrade->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $mig1p2p = $mig1p2p->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $wifiext = $wifiext->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $plc = $plc->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $ottvideo = $ottvideo->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $musik_psb = $musik_psb->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $musik_sales = $musik_sales->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $musik_prepaid = $musik_prepaid->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $indibox = $indibox->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $ihsmart_psb = $ihsmart_psb->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();            
            $ihsmart_sales = $ihsmart_sales->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();            
            $ihsmart_prepaid = $ihsmart_prepaid->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();            
            $ihstudy_psb = $ihstudy_psb->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $ihstudy_sales = $ihstudy_sales->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();
            $ihstudy_prepaid = $ihstudy_prepaid->groupBy("ps","ps_date")->orderBy('ps', 'asc')->get();

            // dd($musik_prepaid);

            // if ($request->periode === $periode_now) {
            //     $request->periode = $periode_now;
            // }

            if (($request->periode != '') && ($request->periode != $periode_now)) {
                foreach ($target_minipack as $target_minipack_val) {
                    if ($target_minipack_val->bulan == $request->periode) {
                        $target_minipack = $target_minipack_val->count; 
                    }        
                }   
                foreach ($minipack_psb as $minipack_psb_val) {
                    if ($minipack_psb_val->ps == $request->periode) {
                        $minipack_psb = $minipack_psb_val->count;
                    } 
                }
                foreach ($minipack_sales as $minipack_sales_val) {
                    if ($minipack_sales_val->ps == $request->periode) {
                        $minipack_sales = $minipack_sales_val->count;
                    } 
                } 
                foreach ($minipack_prepaid as $minipack_prepaid_val) {
                    if ($minipack_prepaid_val->ps == $request->periode) {
                        $minipack_prepaid = $minipack_prepaid_val->count;
                    } 
                } 
                foreach ($target_mig2p3p as $target_mig2p3p_val) {
                    if ($target_mig2p3p_val->bulan == $request->periode) {
                        $target_mig2p3p = $target_mig2p3p_val->count; 
                    }          
                }  
                foreach ($mig2p3p as $mig2p3p_val) {
                    if ($mig2p3p_val->ps == $request->periode) {
                        $mig2p3p = $mig2p3p_val->count;
                    } 
                }  
                foreach ($target_stb as $target_stb_val) {
                    if ($target_stb_val->bulan == $request->periode) {
                        $target_stb = $target_stb_val->count; 
                    }          
                }  
                foreach ($stb as $stb_val) {
                    if ($stb_val->ps == $request->periode) {
                        $stb = $stb_val->count;
                    } 
                }  
                foreach ($target_upgrade as $target_upgrade_val) {
                    if ($target_upgrade_val->bulan == $request->periode) {
                        $target_upgrade = $target_upgrade_val->count; 
                    }          
                }  
                foreach ($upgrade as $upgrade_val) {
                    if ($upgrade_val->ps == $request->periode) {
                        $upgrade = $upgrade_val->count;
                    } 
                }     
                foreach ($target_mig1p2p as $target_mig1p2p_val) {
                    if ($target_mig1p2p_val->bulan == $request->periode) {
                        $target_mig1p2p = $target_mig1p2p_val->count; 
                    }          
                }  
                foreach ($mig1p2p as $mig1p2p_val) {
                    if ($mig1p2p_val->ps == $request->periode) {
                        $mig1p2p = $mig1p2p_val->count;
                    } 
                } 
                foreach ($target_wifiext as $target_wifiext_val) {
                    if ($target_wifiext_val->bulan == $request->periode) {
                        $target_wifiext = $target_wifiext_val->count; 
                    }          
                }  
                foreach ($wifiext as $wifiext_val) {
                    if ($wifiext_val->ps == $request->periode) {
                        $wifiext = $wifiext_val->count;
                    } 
                }
                foreach ($target_plc as $target_plc_val) {
                    if ($target_plc_val->bulan == $request->periode) {
                        $target_plc = $target_plc_val->count; 
                    }          
                }  
                foreach ($plc as $plc_val) {
                    if ($plc_val->ps == $request->periode) {
                        $plc = $plc_val->count;
                    } 
                }  
                foreach ($target_ottvideo as $target_ottvideo_val) {
                    if ($target_ottvideo_val->bulan == $request->periode) {
                        $target_ottvideo = $target_ottvideo_val->count; 
                    }          
                }  
                foreach ($ottvideo as $ottvideo_val) {
                    if ($ottvideo_val->ps == $request->periode) {
                        $ottvideo = $ottvideo_val->count;
                    } 
                }
                foreach ($target_musik as $target_musik_val) {
                    if ($target_musik_val->bulan == $request->periode) {
                        $target_musik = $target_musik_val->count; 
                    }          
                }  
                foreach ($musik_psb as $musik_psb_val) {
                    if ($musik_psb_val->ps == $request->periode) {
                        $musik_psb = $musik_psb_val->count;
                    } 
                }
                foreach ($musik_sales as $musik_sales_val) {
                    if ($musik_sales_val->ps == $request->periode) {
                        $musik_sales = $musik_sales_val->count;
                    } 
                }
                foreach ($musik_prepaid as $musik_prepaid_val) {
                    if ($musik_prepaid_val->ps == $request->periode) {
                        $musik_prepaid = $musik_prepaid_val->count;
                    } 
                }           
                foreach ($target_indibox as $target_indibox_val) {
                    if ($target_indibox_val->bulan == $request->periode) {
                        $target_indibox = $target_indibox_val->count; 
                    }          
                }  
                foreach ($indibox as $indibox_val) {
                    if ($indibox_val->ps == $request->periode) {
                        $indibox = $indibox_val->count;
                    } 
                }  
                foreach ($target_ihsmart as $target_ihsmart_val) {
                    if ($target_ihsmart_val->bulan == $request->periode) {
                        $target_ihsmart = $target_ihsmart_val->count; 
                    }          
                }  
                foreach ($ihsmart_psb as $ihsmart_psb_val) {
                    if ($ihsmart_psb_val->ps == $request->periode) {
                        $ihsmart_psb = $ihsmart_psb_val->count;
                    } 
                } 
                foreach ($ihsmart_sales as $ihsmart_sales_val) {
                    if ($ihsmart_sales_val->ps == $request->periode) {
                        $ihsmart_sales = $ihsmart_sales_val->count;
                    } 
                } 
                foreach ($ihsmart_prepaid as $ihsmart_prepaid_val) {
                    if ($ihsmart_prepaid_val->ps == $request->periode) {
                        $ihsmart_prepaid = $ihsmart_prepaid_val->count;
                    } 
                }               
                foreach ($target_ihstudy as $target_ihstudy_val) {
                    if ($target_ihstudy_val->bulan == $request->periode) {
                        $target_ihstudy = $target_ihstudy_val->count; 
                    }          
                }  
                foreach ($ihstudy_psb as $ihstudy_psb_val) {
                    if ($ihstudy_psb_val->ps == $request->periode) {
                        $ihstudy_psb = $ihstudy_psb_val->count;
                    } 
                }
                foreach ($ihstudy_sales as $ihstudy_sales_val) {
                    if ($ihstudy_sales_val->ps == $request->periode) {
                        $ihstudy_sales = $ihstudy_sales_val->count;
                    } 
                }  
                foreach ($ihstudy_prepaid as $ihstudy_prepaid_val) {
                    if ($ihstudy_prepaid_val->ps == $request->periode) {
                        $ihstudy_prepaid = $ihstudy_prepaid_val->count;
                    } 
                }                                           
            } else {
                foreach ($target_minipack as $target_minipack_val) {
                    if ($target_minipack_val->bulan == $periode_now) {
                        $target_minipack = $target_minipack_val->count; 
                    }          
                }    
                foreach ($minipack_psb as $minipack_psb_val) {
                    if ($minipack_psb_val->ps == $periode_now) {
                        $minipack_psb = $minipack_psb_val->count;                         
                    } else {
                        $minipack_psb = 0;
                    }   
                }
                foreach ($minipack_sales as $minipack_sales_val) {
                    if ($minipack_sales_val->ps == $periode_now) {
                        $minipack_sales = $minipack_sales_val->count;                         
                    } else {
                        $minipack_sales = 0;
                    }   
                }                
                foreach ($minipack_prepaid as $minipack_prepaid_val) {
                    if ($minipack_prepaid_val->ps == $periode_now) {
                        $minipack_prepaid = $minipack_prepaid_val->count;                         
                    } else {
                        $minipack_prepaid = 0;
                    }   
                }
                foreach ($target_mig2p3p as $target_mig2p3p_val) {
                    if ($target_mig2p3p_val->bulan == $periode_now) {
                        $target_mig2p3p = $target_mig2p3p_val->count; 
                    }          
                }    
                foreach ($mig2p3p as $mig2p3p_val) {
                    if ($mig2p3p_val->ps == $periode_now) {
                        $mig2p3p = $mig2p3p_val->count; 
                    } else {
                        $mig2p3p = 0;
                    }       
                }   
                foreach ($target_stb as $target_stb_val) {
                    if ($target_stb_val->bulan == $periode_now) {
                        $target_stb = $target_stb_val->count; 
                    }          
                }    
                foreach ($stb as $stb_val) {
                    if ($stb_val->ps == $periode_now) {
                        $stb = $stb_val->count; 
                    } else {
                        $stb = 0;
                    } 
                }   
                foreach ($target_upgrade as $target_upgrade_val) {
                    if ($target_upgrade_val->bulan == $periode_now) {
                        $target_upgrade = $target_upgrade_val->count; 
                    }          
                }    
                foreach ($upgrade as $upgrade_val) {
                    if ($upgrade_val->ps == $periode_now) {
                        $upgrade = $upgrade_val->count; 
                    } else {
                        $upgrade = 0;
                    } 
                }  
                foreach ($target_mig1p2p as $target_mig1p2p_val) {
                    if ($target_mig1p2p_val->bulan == $periode_now) {
                        $target_mig1p2p = $target_mig1p2p_val->count; 
                    }          
                }    
                foreach ($mig1p2p as $mig1p2p_val) {
                    if ($mig1p2p_val->ps == $periode_now) {
                        $mig1p2p = $mig1p2p_val->count; 
                    } else {
                        $mig1p2p = 0;
                    } 
                }  
                foreach ($target_wifiext as $target_wifiext_val) {
                    if ($target_wifiext_val->bulan == $periode_now) {
                        $target_wifiext = $target_wifiext_val->count; 
                    }          
                }    
                foreach ($wifiext as $wifiext_val) {
                    if ($wifiext_val->ps == $periode_now) {
                        $wifiext = $wifiext_val->count; 
                    } else {
                        $wifiext = 0;
                    } 
                }
                foreach ($target_plc as $target_plc_val) {
                    if ($target_plc_val->bulan == $periode_now) {
                        $target_plc = $target_plc_val->count; 
                    }          
                }    
                foreach ($plc as $plc_val) {
                    if ($plc_val->ps == $periode_now) {
                        $plc = $plc_val->count; 
                    } else {
                        $plc = 0;
                    } 
                }
                foreach ($target_ottvideo as $target_ottvideo_val) {
                    if ($target_ottvideo_val->bulan == $periode_now) {
                        $target_ottvideo = $target_ottvideo_val->count; 
                    }          
                }    
                foreach ($ottvideo as $ottvideo_val) {
                    if ($ottvideo_val->ps == $periode_now) {
                        $ottvideo = $ottvideo_val->count; 
                    } else {
                        $ottvideo = 0;
                    }
                }
                foreach ($target_musik as $target_musik_val) {
                    if ($target_musik_val->bulan == $periode_now) {
                        $target_musik = $target_musik_val->count; 
                    }          
                }    
                foreach ($musik_psb as $musik_psb_val) {
                    if ($musik_psb_val->ps == $periode_now) {
                        $musik_psb = $musik_psb_val->count; 
                    } else {
                        $musik_psb = 0;
                    } 
                }
                foreach ($musik_sales as $musik_sales_val) {
                    if ($musik_sales_val->ps == $periode_now) {
                        $musik_sales = $musik_sales_val->count; 
                    } else {
                        $musik_sales = 0;
                    } 
                }
                foreach ($musik_prepaid as $musik_prepaid_val) {
                    if ($musik_prepaid_val->ps == $periode_now) {
                        $musik_prepaid = $musik_prepaid_val->count; 
                    } else {
                        $musik_prepaid = 0;
                    } 
                }
                foreach ($target_indibox as $target_indibox_val) {
                    if ($target_indibox_val->bulan == $periode_now) {
                        $target_indibox = $target_indibox_val->count; 
                    }          
                }    
                foreach ($indibox as $indibox_val) {
                    if ($indibox_val->ps == $periode_now) {
                        $indibox = $indibox_val->count; 
                    } else {
                        $indibox = 0;
                    }
                } 
                foreach ($target_ihsmart as $target_ihsmart_val) {
                    if ($target_ihsmart_val->bulan == $periode_now) {
                        $target_ihsmart = $target_ihsmart_val->count; 
                    }        
                }    
                foreach ($ihsmart_psb as $ihsmart_psb_val) {
                    if ($ihsmart_psb_val->ps == $periode_now) {
                        $ihsmart_psb = $ihsmart_psb_val->count; 
                    } else {
                        $ihsmart_psb = 0;
                    } 
                } 
                foreach ($ihsmart_sales as $ihsmart_sales_val) {
                    if ($ihsmart_sales_val->ps == $periode_now) {
                        $ihsmart_sales = $ihsmart_sales_val->count; 
                    } else {
                        $ihsmart_sales = 0;
                    } 
                } 
                foreach ($ihsmart_prepaid as $ihsmart_prepaid_val) {
                    if ($ihsmart_prepaid_val->ps == $periode_now) {
                        $ihsmart_prepaid = $ihsmart_prepaid_val->count; 
                    } else {
                        $ihsmart_prepaid = 0;
                    } 
                }                
                foreach ($target_ihstudy as $target_ihstudy_val) {
                    if ($target_ihstudy_val->bulan == $periode_now) {
                        $target_ihstudy = $target_ihstudy_val->count; 
                    }          
                }    
                foreach ($ihstudy_psb as $ihstudy_psb_val) {
                    if ($ihstudy_psb_val->ps == $periode_now) {
                        $ihstudy_psb = $ihstudy_psb_val->count; 
                    } else {
                        $ihstudy_psb = 0;
                    } 
                }  
                foreach ($ihstudy_sales as $ihstudy_sales_val) {
                    if ($ihstudy_sales_val->ps == $periode_now) {
                        $ihstudy_sales = $ihstudy_sales_val->count; 
                    } else {
                        $ihstudy_sales = 0;
                    } 
                } 
                foreach ($ihstudy_prepaid as $ihstudy_prepaid_val) {
                    if ($ihstudy_prepaid_val->ps == $periode_now) {
                        $ihstudy_prepaid = $ihstudy_prepaid_val->count; 
                    } else {
                        $ihstudy_prepaid = 0;
                    } 
                }                       
            }   

            // dd($mig1p2p);

            $minipack_psb = is_numeric($minipack_psb) ? $minipack_psb : 0;
            $minipack_sales = is_numeric($minipack_sales) ? $minipack_sales : 0;
            $musik_psb = is_numeric($musik_psb) ? $musik_psb : 0;
            $musik_sales = is_numeric($musik_sales) ? $musik_sales : 0;
            $ihsmart_psb = is_numeric($ihsmart_psb) ? $ihsmart_psb : 0;
            $ihsmart_sales = is_numeric($ihsmart_sales) ? $ihsmart_sales : 0;
            $ihstudy_psb = is_numeric($ihstudy_psb) ? $ihstudy_psb : 0;
            $ihstudy_sales = is_numeric($ihstudy_sales) ? $ihstudy_sales : 0;

            $mig1p2p = is_numeric($mig1p2p) ? $mig1p2p : 0;
            $wifiext = is_numeric($wifiext) ? $wifiext : 0;

            $minipack_prepaid = is_numeric($minipack_prepaid) ? $minipack_prepaid : 0;
            $musik_prepaid = is_numeric($musik_prepaid) ? $musik_prepaid : 0;
            $ihsmart_prepaid = is_numeric($ihsmart_prepaid) ? $ihsmart_prepaid : 0;
            $ihstudy_prepaid = is_numeric($ihstudy_prepaid) ? $ihstudy_prepaid : 0;
            
            @$total_minipack = $minipack_psb + $minipack_sales + $minipack_prepaid;
            @$total_musik = $musik_psb + $musik_sales + $musik_prepaid;  
            @$total_ihsmart = $ihsmart_psb + $ihsmart_sales + $ihsmart_prepaid;  
            @$total_ihstudy = $ihstudy_psb + $ihstudy_sales + $ihstudy_prepaid;

            @$ach_minipack = round(($total_minipack / $target_minipack) * 100); 
            @$ach_mig2p3p = round(($mig2p3p / $target_mig2p3p) * 100); 
            @$ach_stb = round(($stb / $target_stb) * 100); 
            @$ach_upgrade = round(($upgrade / $target_upgrade) * 100); 
            @$ach_mig1p2p = round(($mig1p2p / $target_mig1p2p) * 100);
            @$ach_wifiext = round(($wifiext / $target_wifiext) * 100);
            @$ach_plc = round(($plc / $target_plc) * 100);
            @$ach_ottvideo = round(($ottvideo / $target_ottvideo) * 100);
            @$ach_musik = round(($total_musik / $target_musik) * 100);
            @$ach_indibox = round(($indibox / $target_indibox) * 100);
            @$ach_ihsmart = round(($total_ihsmart / $target_ihsmart) * 100);
            @$ach_ihstudy = round(($total_ihstudy / $target_ihstudy) * 100);
           
            $data = [
                'target_minipack' => $target_minipack,
                'minipack' => $total_minipack,
                'minipack_psb' => $minipack_psb,
                'minipack_sales' => $minipack_sales,
                'minipack_prepaid' => $minipack_prepaid,
                'ach_minipack' => $ach_minipack,
                'target_mig2p3p' => $target_mig2p3p,
                'mig2p3p' => $mig2p3p,
                'ach_mig2p3p' => $ach_mig2p3p,
                'target_stb' => $target_stb,
                'stb' => $stb,
                'ach_stb' => $ach_stb,
                'target_upgrade' => $target_upgrade,
                'upgrade' => $upgrade,
                'ach_upgrade' => $ach_upgrade,
                'target_mig1p2p' => $target_mig1p2p,
                'mig1p2p' => $mig1p2p,
                'ach_mig1p2p' => $ach_mig1p2p,
                'target_wifiext' => $target_wifiext,
                'wifiext' => $wifiext,
                'ach_wifiext' => $ach_wifiext,
                'target_plc' => $target_plc,
                'plc' => $plc,
                'ach_plc' => $ach_plc,
                'target_ottvideo' => $target_ottvideo,
                'ottvideo' => $ottvideo,
                'ach_ottvideo' => $ach_ottvideo,
                'target_musik' => $target_musik,
                'musik' => $total_musik,
                'musik_psb' => $musik_psb,
                'musik_sales' => $musik_sales,
                'musik_prepaid' => $musik_prepaid,
                'ach_musik' => $ach_musik,
                'target_indibox' => $target_indibox,
                'indibox' => $indibox,
                'ach_indibox' => $ach_indibox,
                'target_ihsmart' => $target_ihsmart,
                'ihsmart' => $total_ihsmart,  
                'ihsmart_psb' => $ihsmart_psb,
                'ihsmart_sales' => $ihsmart_sales,
                'ihsmart_prepaid' => $ihsmart_prepaid,             
                'ach_ihsmart' => $ach_ihsmart,
                'target_ihstudy' => $target_ihstudy,
                'ihstudy' => $total_ihstudy,
                'ihstudy_psb' => $ihstudy_psb,
                'ihstudy_sales' => $ihstudy_sales,
                'ihstudy_prepaid' => $ihstudy_prepaid,
                'ach_ihstudy' => $ach_ihstudy,                        
            ];

            return response()->json($data);

        }

        $periodes = DB::connection('pg2')->table('target_addon_2021')
            ->select('bulan')->where('bulan', '<=', $periode_now)->orderBy('bulan', 'desc')->distinct()->get();

        return view ('admin.reportCustomer.achaddon.index', compact('periodes'));
    }

    public function plasa(Request $request)
    {
        $arr_labels_date = [];

        $arr_counts_all = [];
        $arr_counts_mig2p = [];
        $arr_counts_mig3p = [];

        $date_now = date('Ym');
        $date_one_year = date('Ym', strtotime('-1 years + 1 month'));

        if ($request->ajax()) {

            $target_plasa = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            );   
            
            $target_balikpapan = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            )->where('witel', 'BALIKPAPAN');   

            $target_kalbar = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            )->where('witel', 'KALBAR');  

            $target_kalsel = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            )->where('witel', 'KALSEL'); 
            
            $target_kaltara = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            )->where('witel', 'KALTARA'); 

            $target_kalteng = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            )->where('witel', 'KALTENG'); 

            $target_samarinda = DB::connection('pg11')->table('target_psb_plasa')
            ->select(
                'bulan',
                DB::raw("sum(target) as count")
            )->where('witel', 'SAMARINDA'); 

            $psb_plasa = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            );

            $psb_balikpapan = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            )->where('witel', 'BALIKPAPAN'); 
            
            $psb_kalbar = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            )->where('witel', 'KALBAR'); 

            $psb_kalsel = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            )->where('witel', 'KALSEL');
            
            $psb_kaltara = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            )->where('witel', 'KALTARA');

            $psb_kalteng = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            )->where('witel', 'KALTENG');

            $psb_samarinda = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            )->where('witel', 'SAMARINDA');

            $query_all = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'bulanps',
                DB::raw("sum(jumlah) as count")
            );

            $query_mig2p = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'indihome', 'bulanps',
                DB::raw("sum(jumlah) as count")
            )
            ->where('indihome', '2P');

            $query_mig3p = DB::connection('pg11')->table('rekap_psb_witel')
            ->select(
                'indihome', 'bulanps',
                DB::raw("sum(jumlah) as count")
            )
            ->where('indihome', '3P');

            if ($request->witel != '') {
                $query_all = $query_all->where('witel', $request->witel);
                $query_mig2p = $query_mig2p->where('witel', $request->witel);
                $query_mig3p = $query_mig3p->where('witel', $request->witel);                
            } 

            if ($request->start_periode != '' && $request->end_periode != '') {
                $query_all = $query_all->where('bulanps', '>=', $request->start_periode)->where('bulanps', '<=', $request->end_periode);
                $query_mig2p = $query_mig2p->where('bulanps', '>=', $request->start_periode)->where('bulanps', '<=', $request->end_periode);
                $query_mig3p = $query_mig3p->where('bulanps', '>=', $request->start_periode)->where('bulanps', '<=', $request->end_periode);
            } else {
                $query_all = $query_all->where('bulanps', '>=', $date_one_year)->where('bulanps', '<=', $date_now);
                $query_mig2p = $query_mig2p->where('bulanps', '>=', $date_one_year)->where('bulanps', '<=', $date_now);
                $query_mig3p = $query_mig3p->where('bulanps', '>=', $date_one_year)->where('bulanps', '<=', $date_now);
            }

            // if ($request->ach_witel != '') {                
            //     $target_plasa = $target_plasa->where('witel', $request->ach_witel);
            //     $psb_plasa = $psb_plasa->where('witel', $request->ach_witel);
            // }

            if (($request->ach_periode != '') && ($request->ach_periode != $date_now)) {
                $target_plasa = $target_plasa->where('bulan', $request->ach_periode);
                $target_balikpapan = $target_balikpapan->where('bulan', $request->ach_periode);
                $target_kalbar = $target_kalbar->where('bulan', $request->ach_periode);
                $target_kalsel = $target_kalsel->where('bulan', $request->ach_periode);
                $target_kaltara = $target_kaltara->where('bulan', $request->ach_periode);
                $target_kalteng = $target_kalteng->where('bulan', $request->ach_periode);
                $target_samarinda = $target_samarinda->where('bulan', $request->ach_periode);

                $psb_plasa = $psb_plasa->where('bulanps', $request->ach_periode);
                $psb_balikpapan = $psb_balikpapan->where('bulanps', $request->ach_periode);
                $psb_kalbar = $psb_kalbar->where('bulanps', $request->ach_periode);
                $psb_kalsel = $psb_kalsel->where('bulanps', $request->ach_periode);
                $psb_kaltara = $psb_kaltara->where('bulanps', $request->ach_periode);
                $psb_kalteng = $psb_kalteng->where('bulanps', $request->ach_periode);
                $psb_samarinda = $psb_samarinda->where('bulanps', $request->ach_periode);
            } else {
                $target_plasa = $target_plasa->where('bulan', $date_now);
                $target_balikpapan = $target_balikpapan->where('bulan', $date_now);
                $target_kalbar = $target_kalbar->where('bulan', $date_now);
                $target_kalsel = $target_kalsel->where('bulan', $date_now);
                $target_kaltara = $target_kaltara->where('bulan', $date_now);
                $target_kalteng = $target_kalteng->where('bulan', $date_now);
                $target_samarinda = $target_samarinda->where('bulan', $date_now);

                $psb_plasa = $psb_plasa->where('bulanps', $date_now);
                $psb_balikpapan = $psb_balikpapan->where('bulanps', $date_now);
                $psb_kalbar = $psb_kalbar->where('bulanps', $date_now);
                $psb_kalsel = $psb_kalsel->where('bulanps', $date_now);
                $psb_kaltara = $psb_kaltara->where('bulanps', $date_now);
                $psb_kalteng = $psb_kalteng->where('bulanps', $date_now);
                $psb_samarinda = $psb_samarinda->where('bulanps', $date_now);
            }

            $target_plasa = $target_plasa->groupBy("bulan")->orderBy('bulan', 'asc')->get();
            $target_balikpapan = $target_balikpapan->groupBy("bulan")->orderBy('bulan', 'asc')->get();
            $target_kalbar = $target_kalbar->groupBy("bulan")->orderBy('bulan', 'asc')->get();
            $target_kalsel = $target_kalsel->groupBy("bulan")->orderBy('bulan', 'asc')->get();
            $target_kaltara = $target_kaltara->groupBy("bulan")->orderBy('bulan', 'asc')->get();
            $target_kalteng = $target_kalteng->groupBy("bulan")->orderBy('bulan', 'asc')->get();
            $target_samarinda = $target_samarinda->groupBy("bulan")->orderBy('bulan', 'asc')->get();

            $psb_plasa = $psb_plasa->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $psb_balikpapan = $psb_balikpapan->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $psb_kalbar = $psb_kalbar->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $psb_kalsel = $psb_kalsel->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $psb_kaltara = $psb_kaltara->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $psb_kalteng = $psb_kalteng->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $psb_samarinda = $psb_samarinda->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();

            $query_all = $query_all->groupBy("bulanps")->orderBy('bulanps', 'asc')->get();
            $query_mig2p = $query_mig2p->groupBy("indihome","bulanps")->orderBy('bulanps', 'asc')->get();
            $query_mig3p = $query_mig3p->groupBy("indihome","bulanps")->orderBy('bulanps', 'asc')->get();
            
            foreach ($target_plasa as $target_plasa_val) {
                $target_plasa = $target_plasa_val->count;
            }

            foreach ($target_balikpapan as $target_balikpapan_val) {
                $target_balikpapan = $target_balikpapan_val->count;
            }

            foreach ($target_kalbar as $target_kalbar_val) {
                $target_kalbar = $target_kalbar_val->count;
            }

            foreach ($target_kalsel as $target_kalsel_val) {
                $target_kalsel = $target_kalsel_val->count;
            }

            foreach ($target_kaltara as $target_kaltara_val) {
                $target_kaltara = $target_kaltara_val->count;
            }

            foreach ($target_kalteng as $target_kalteng_val) {
                $target_kalteng = $target_kalteng_val->count;
            }

            foreach ($target_samarinda as $target_samarinda_val) {
                $target_samarinda = $target_samarinda_val->count;
            }

            if (count($psb_plasa) >= 1) {
                foreach ($psb_plasa as $psb_plasa_val) {
                    $psb_plasa = $psb_plasa_val->count;
                }
            } else {
                $psb_plasa = 0;
            }

            if (count($psb_balikpapan) >= 1) {
                foreach ($psb_balikpapan as $psb_balikpapan_val) {
                    $psb_balikpapan = $psb_balikpapan_val->count;
                }
            } else {
                $psb_balikpapan = 0;
            }

            if (count($psb_kalbar) >= 1) {
                foreach ($psb_kalbar as $psb_kalbar_val) {
                    $psb_kalbar = $psb_kalbar_val->count;
                }
            } else {
                $psb_kalbar = 0;
            }

            if (count($psb_kalsel) >= 1) {
                foreach ($psb_kalsel as $psb_kalsel_val) {
                    $psb_kalsel = $psb_kalsel_val->count;
                }
            } else {
                $psb_kalsel = 0;
            }

            if (count($psb_kaltara) >= 1) {
                foreach ($psb_kaltara as $psb_kaltara_val) {
                    $psb_kaltara = $psb_kaltara_val->count;
                }
            } else {
                $psb_kaltara = 0;
            }

            if (count($psb_kalteng) >= 1) {
                foreach ($psb_kalteng as $psb_kalteng_val) {
                    $psb_kalteng = $psb_kalteng_val->count;
                }
            } else {
                $psb_kalteng = 0;
            }

            if (count($psb_samarinda) >= 1) {
                foreach ($psb_samarinda as $psb_samarinda_val) {
                    $psb_samarinda = $psb_samarinda_val->count;
                }
            } else {
                $psb_samarinda = 0;
            }
            
            foreach ($query_all as $val) {            
                array_push($arr_labels_date, '"'.$val->bulanps.'"');
                array_push($arr_counts_all, $val->count);
            }

            foreach ($query_mig2p as $mig2p) {
                array_push($arr_counts_mig2p, $mig2p->count);
            }

            foreach ($query_mig3p as $mig3p) {            
                array_push($arr_counts_mig3p, $mig3p->count);
            }

            @$ach_plasa = round(($psb_plasa / $target_plasa) * 100); 
            @$ach_balikpapan = round(($psb_balikpapan / $target_balikpapan) * 100); 
            @$ach_kalbar = round(($psb_kalbar / $target_kalbar) * 100); 
            @$ach_kalsel = round(($psb_kalsel / $target_kalsel) * 100); 
            @$ach_kaltara = round(($psb_kaltara / $target_kaltara) * 100); 
            @$ach_kalteng = round(($psb_kalteng / $target_kalteng) * 100); 
            @$ach_samarinda = round(($psb_samarinda / $target_samarinda) * 100); 

            $arr_labels_date = implode(',', $arr_labels_date);
            $arr_counts_all = implode(',', $arr_counts_all);
            $arr_counts_mig2p = implode(',', $arr_counts_mig2p);
            $arr_counts_mig3p = implode(',', $arr_counts_mig3p);

            $data = [
                'labels_date_psplasa' => '['.$arr_labels_date.']',
                'total_counts_all' => '['.$arr_counts_all.']',
                'total_counts_mig2p' => '['.$arr_counts_mig2p.']',
                'total_counts_mig3p' => '['.$arr_counts_mig3p.']',
                'target_plasa' => $target_plasa,
                'plasa' => $psb_plasa,
                'ach_plasa' => $ach_plasa,
                'target_balikpapan' => $target_balikpapan,
                'balikpapan' => $psb_balikpapan,
                'ach_balikpapan' => $ach_balikpapan,
                'target_kalbar' => $target_kalbar,
                'kalbar' => $psb_kalbar,
                'ach_kalbar' => $ach_kalbar,
                'target_kalsel' => $target_kalsel,
                'kalsel' => $psb_kalsel,
                'ach_kalsel' => $ach_kalsel,
                'target_kaltara' => $target_kaltara,
                'kaltara' => $psb_kaltara,
                'ach_kaltara' => $ach_kaltara,
                'target_kalteng' => $target_kalteng,
                'kalteng' => $psb_kalteng,
                'ach_kalteng' => $ach_kalteng,
                'target_samarinda' => $target_samarinda,
                'samarinda' => $psb_samarinda,
                'ach_samarinda' => $ach_samarinda
            ];

            return response()->json($data);
        }
        
        $witels = Witel::get(['id', 'nama_witel']);
        $periodes = DB::connection('pg11')->table('rekap_psb_witel')
            ->select('bulanps')->orderBy('bulanps', 'desc')->distinct()->get();
        $periodes_ach = DB::connection('pg11')->table('target_psb_plasa')
            ->select('bulan')->where('bulan', '<=', $date_now)->orderBy('bulan', 'desc')->distinct()->get();

        return view ('admin.reportCustomer.plasa.index', compact('witels', 'periodes','periodes_ach'));
    }

    public function ct0(Request $request)
    {   
        $arr_labels_ct0 = [];
        $arr_counts_alltreg_ct0 = [];
        $arr_counts_balikpapan_ct0 = [];
        $arr_counts_kalbar_ct0 = [];
        $arr_counts_kalsel_ct0 = [];
        $arr_counts_kaltara_ct0 = [];
        $arr_counts_kalteng_ct0 = [];
        $arr_counts_samarinda_ct0 = [];

        $arr_counts_alltreg_unbill = [];
        $arr_counts_balikpapan_unbill = [];
        $arr_counts_kalbar_unbill = [];
        $arr_counts_kalsel_unbill = [];
        $arr_counts_kaltara_unbill = [];
        $arr_counts_kalteng_unbill = [];
        $arr_counts_samarinda_unbill = [];

        $arr_counts_alltreg_psb = [];
        $arr_counts_balikpapan_psb = [];
        $arr_counts_kalbar_psb = [];
        $arr_counts_kalsel_psb = [];
        $arr_counts_kaltara_psb = [];
        $arr_counts_kalteng_psb = [];
        $arr_counts_samarinda_psb = [];

        if ($request->ajax()) {
            $alltreg_ct0 = DB::connection('pg12')->table('length_of_stay')
            ->select(
                'bulan_ke',
                DB::raw("sum(jml_psb) as jml_psb"),
                DB::raw("sum(unbill) as unbill")
            );
            $balikpapan_ct0 =  DB::connection('pg12')->table('length_of_stay')->where('witel', 'BALIKPAPAN');
            $kalbar_ct0 =  DB::connection('pg12')->table('length_of_stay')->where('witel', 'KALBAR');
            $kalsel_ct0 =  DB::connection('pg12')->table('length_of_stay')->where('witel', 'KALSEL');
            $kaltara_ct0 =  DB::connection('pg12')->table('length_of_stay')->where('witel', 'KALTARA');
            $kalteng_ct0 =  DB::connection('pg12')->table('length_of_stay')->where('witel', 'KALTENG');
            $samarinda_ct0 =  DB::connection('pg12')->table('length_of_stay')->where('witel', 'SAMARINDA');

            if ($request->periode != '') {
                $alltreg_ct0 = $alltreg_ct0->where('bulan_psb', $request->periode);
                $balikpapan_ct0 = $balikpapan_ct0->where('bulan_psb', $request->periode);
                $kalbar_ct0 =  $kalbar_ct0->where('bulan_psb', $request->periode);
                $kalsel_ct0 =  $kalsel_ct0->where('bulan_psb', $request->periode);
                $kaltara_ct0 =  $kaltara_ct0->where('bulan_psb', $request->periode);
                $kalteng_ct0 =  $kalteng_ct0->where('bulan_psb', $request->periode);
                $samarinda_ct0 =  $samarinda_ct0->where('bulan_psb', $request->periode);
            } else {
                $alltreg_ct0 = $alltreg_ct0->where('bulan_psb', '202004');
                $balikpapan_ct0 = $balikpapan_ct0->where('bulan_psb', '202004');
                $kalbar_ct0 =  $kalbar_ct0->where('bulan_psb', '202004');
                $kalsel_ct0 =  $kalsel_ct0->where('bulan_psb', '202004');
                $kaltara_ct0 =  $kaltara_ct0->where('bulan_psb', '202004');
                $kalteng_ct0 =  $kalteng_ct0->where('bulan_psb', '202004');
                $samarinda_ct0 =  $samarinda_ct0->where('bulan_psb', '202004');
            }

            $alltreg_ct0 = $alltreg_ct0->groupBy('bulan_ke')->orderBy('bulan_ke', 'asc')->get();
            $balikpapan_ct0 = $balikpapan_ct0->orderBy('bulan_ke', 'asc')->get();
            $kalbar_ct0 =  $kalbar_ct0->orderBy('bulan_ke', 'asc')->get();
            $kalsel_ct0 =  $kalsel_ct0->orderBy('bulan_ke', 'asc')->get();
            $kaltara_ct0 =  $kaltara_ct0->orderBy('bulan_ke', 'asc')->get();
            $kalteng_ct0 =  $kalteng_ct0->orderBy('bulan_ke', 'asc')->get();
            $samarinda_ct0 =  $samarinda_ct0->orderBy('bulan_ke', 'asc')->get();  

            foreach ($alltreg_ct0 as $alltrg_ct0) {
                $percentage = (1 - ($alltrg_ct0->unbill / $alltrg_ct0->jml_psb)) * 100;
                array_push($arr_counts_alltreg_ct0, number_format($percentage, 2));
                array_push($arr_counts_alltreg_unbill, $alltrg_ct0->unbill);
                array_push($arr_counts_alltreg_psb, $alltrg_ct0->jml_psb);

                array_push($arr_labels_ct0, '"'."bln ke ".$alltrg_ct0->bulan_ke.'"');
            }

            foreach ($balikpapan_ct0 as $bpn_ct0) {
                $percentage = (1 - ($bpn_ct0->unbill / $bpn_ct0->jml_psb)) * 100;
                array_push($arr_counts_balikpapan_ct0, number_format($percentage, 2));
                array_push($arr_counts_balikpapan_unbill, $bpn_ct0->unbill);
                array_push($arr_counts_balikpapan_psb, $bpn_ct0->jml_psb);
            }

            foreach ($kalbar_ct0 as $klb_ct0) {
                $percentage = (1 - ($klb_ct0->unbill / $klb_ct0->jml_psb)) * 100;
                array_push($arr_counts_kalbar_ct0, number_format($percentage, 2));
                array_push($arr_counts_kalbar_unbill, $klb_ct0->unbill);
                array_push($arr_counts_kalbar_psb, $klb_ct0->jml_psb);
            }

            foreach ($kalsel_ct0 as $kls_ct0) {
                $percentage = (1 - ($kls_ct0->unbill / $kls_ct0->jml_psb)) * 100;
                array_push($arr_counts_kalsel_ct0, number_format($percentage, 2));
                array_push($arr_counts_kalsel_unbill, $kls_ct0->unbill);
                array_push($arr_counts_kalsel_psb, $kls_ct0->jml_psb);
            }

            foreach ($kaltara_ct0 as $klt_ct0) {
                $percentage = (1 - ($klt_ct0->unbill / $klt_ct0->jml_psb)) * 100;
                array_push($arr_counts_kaltara_ct0, number_format($percentage, 2));
                array_push($arr_counts_kaltara_unbill, $klt_ct0->unbill);
                array_push($arr_counts_kaltara_psb, $klt_ct0->jml_psb);
            }

            foreach ($kalteng_ct0 as $ktg_ct0) {
                $percentage = (1 - ($ktg_ct0->unbill / $ktg_ct0->jml_psb)) * 100;
                array_push($arr_counts_kalteng_ct0, number_format($percentage, 2));
                array_push($arr_counts_kalteng_unbill, $ktg_ct0->unbill);
                array_push($arr_counts_kalteng_psb, $ktg_ct0->jml_psb);
            }

            foreach ($samarinda_ct0 as $smd_ct0) {
                $percentage = (1 - ($smd_ct0->unbill / $smd_ct0->jml_psb)) * 100;
                array_push($arr_counts_samarinda_ct0, number_format($percentage, 2));
                array_push($arr_counts_samarinda_unbill, $smd_ct0->unbill);
                array_push($arr_counts_samarinda_psb, $smd_ct0->jml_psb);
            }

            $arr_labels_ct0 = implode(',', $arr_labels_ct0);
            $arr_counts_alltreg_ct0 = implode(',', $arr_counts_alltreg_ct0);
            $arr_counts_balikpapan_ct0 = implode(',', $arr_counts_balikpapan_ct0);
            $arr_counts_kalbar_ct0 = implode(',', $arr_counts_kalbar_ct0);
            $arr_counts_kalsel_ct0 = implode(',', $arr_counts_kalsel_ct0);
            $arr_counts_kaltara_ct0 = implode(',', $arr_counts_kaltara_ct0);
            $arr_counts_kalteng_ct0 = implode(',', $arr_counts_kalteng_ct0);
            $arr_counts_samarinda_ct0 = implode(',', $arr_counts_samarinda_ct0);

            $arr_counts_alltreg_unbill = implode(',', $arr_counts_alltreg_unbill);
            $arr_counts_balikpapan_unbill = implode(',', $arr_counts_balikpapan_unbill);
            $arr_counts_kalbar_unbill = implode(',', $arr_counts_kalbar_unbill);
            $arr_counts_kalsel_unbill = implode(',', $arr_counts_kalsel_unbill);
            $arr_counts_kaltara_unbill = implode(',', $arr_counts_kaltara_unbill);
            $arr_counts_kalteng_unbill = implode(',', $arr_counts_kalteng_unbill);
            $arr_counts_samarinda_unbill = implode(',', $arr_counts_samarinda_unbill);

            $arr_counts_alltreg_psb = implode(',', $arr_counts_alltreg_psb);
            $arr_counts_balikpapan_psb = implode(',', $arr_counts_balikpapan_psb);
            $arr_counts_kalbar_psb = implode(',', $arr_counts_kalbar_psb);
            $arr_counts_kalsel_psb = implode(',', $arr_counts_kalsel_psb);
            $arr_counts_kaltara_psb = implode(',', $arr_counts_kaltara_psb);
            $arr_counts_kalteng_psb = implode(',', $arr_counts_kalteng_psb);
            $arr_counts_samarinda_psb = implode(',', $arr_counts_samarinda_psb);

            $data = [
                'labels_ct0' => '['.$arr_labels_ct0.']',
                'total_counts_alltreg' => '['.$arr_counts_alltreg_ct0.']',
                'total_counts_balikpapan' => '['.$arr_counts_balikpapan_ct0.']',
                'total_counts_kalbar' => '['.$arr_counts_kalbar_ct0.']',
                'total_counts_kalsel' => '['.$arr_counts_kalsel_ct0.']',
                'total_counts_kaltara' => '['.$arr_counts_kaltara_ct0.']',
                'total_counts_kalteng' => '['.$arr_counts_kalteng_ct0.']',
                'total_counts_samarinda' => '['.$arr_counts_samarinda_ct0.']',

                'total_counts_alltreg_unbill' => '['.$arr_counts_alltreg_unbill.']',
                'total_counts_balikpapan_unbill' => '['.$arr_counts_balikpapan_unbill.']',
                'total_counts_kalbar_unbill' => '['.$arr_counts_kalbar_unbill.']',
                'total_counts_kalsel_unbill' => '['.$arr_counts_kalsel_unbill.']',
                'total_counts_kaltara_unbill' => '['.$arr_counts_kaltara_unbill.']',
                'total_counts_kalteng_unbill' => '['.$arr_counts_kalteng_unbill.']',
                'total_counts_samarinda_unbill' => '['.$arr_counts_samarinda_unbill.']',

                'total_counts_alltreg_psb' => '['.$arr_counts_alltreg_psb.']',
                'total_counts_balikpapan_psb' => '['.$arr_counts_balikpapan_psb.']',
                'total_counts_kalbar_psb' => '['.$arr_counts_kalbar_psb.']',
                'total_counts_kalsel_psb' => '['.$arr_counts_kalsel_psb.']',
                'total_counts_kaltara_psb' => '['.$arr_counts_kaltara_psb.']',
                'total_counts_kalteng_psb' => '['.$arr_counts_kalteng_psb.']',
                'total_counts_samarinda_psb' => '['.$arr_counts_samarinda_psb.']',
            ];

            return response()->json($data);
        }

        $periodes_ct0 = DB::connection('pg12')->table('length_of_stay')
            ->select('bulan_psb')->orderBy('bulan_psb', 'desc')->distinct()->get();

        return view ('admin.reportCustomer.ct0.index', compact('periodes_ct0'));
    }
}
