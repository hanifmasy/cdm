<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProspectExport;
use App\Http\Controllers\Controller;
use App\Models\FilterMinipack;
use App\Models\MasterData;
use App\Models\MasterDataTreg;
use App\Models\Witel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Rap2hpoutre\FastExcel\FastExcel;

class ProspectController extends Controller
{
    public function index(Request $request)
    {       
        if($request->ajax()){
               
            if (empty($request->all())) {
                $data['customers'] = MasterDataTreg::where('root_status', 'Active')->where('cprod', '11')->where('linecats_item_id', '<', '400')->count();
                $data['mobiles'] = MasterDataTreg::where('root_status', 'Active')->where('cprod', '11')->where('linecats_item_id', '<', '400')->where('no_hp', '!=', null)->count();
                $data['email'] = MasterDataTreg::where('root_status', 'Active')->where('cprod', '11')->where('linecats_item_id', '<', '400')->where('email_myih', '!=', null)->count();
            } else {
                $request->session()->forget('params');
                $request->session()->put('params', $request->all());                    
                $query = DB::connection('pg7')->table('smartprofile');
                $table = DB::connection('pg7')->table('smartprofile');
                if($request->witel)
                {
                    $query->whereIn('witel_str', $request->witel);
                    $table->whereIn('witel_str', $request->witel);
                }
                if($request->indihome)
                {                    
                    $query->WhereIn('1p_2p_3p', $request->indihome);
                    $table->WhereIn('1p_2p_3p', $request->indihome);                 
                }
                if($request->customer)
                {
                    $query->WhereIn('plblcl_trems', $request->customer);
                    $table->WhereIn('plblcl_trems', $request->customer);
                }
                if($request->useetv)
                {                                                                             
                    $query->WhereIn('jenis_useetv', $request->useetv);  
                    $table->WhereIn('jenis_useetv', $request->useetv);  
                    if (in_array(null, $request->useetv)){
                        $query->orWhereNull('jenis_useetv');
                        $table->orWhereNull('jenis_useetv');
                    }
                }
                if($request->gangguan)
                {                                                                             
                    $query->WhereIn('status_gangguan', $request->gangguan);  
                    $table->WhereIn('status_gangguan', $request->gangguan);  
                }
                if($request->minipack)
                {                
                    if(count($request->minipack) == 1)
                    {
                        if (in_array("mp_combo_sport", $request->minipack)){
                            $query->Where('mp_combo_sport', 'OK');  
                            $table->Where('mp_combo_sport', 'OK');  
                        }
                        if (in_array("mp_dynasti_2", $request->minipack)){
                            $query->Where('mp_dynasti_2', 'OK');  
                            $table->Where('mp_dynasti_2', 'OK');  
                        }
                        if (in_array("mp_essential", $request->minipack)){
                            $query->Where('mp_essential', 'OK');  
                            $table->Where('mp_essential', 'OK');  
                        }
                        if (in_array("mp_extra_hd", $request->minipack)){
                            $query->Where('mp_extra_hd', 'OK');  
                            $table->Where('mp_extra_hd', 'OK');  
                        }
                        if (in_array("mp_indi_basketball", $request->minipack)){
                            $query->Where('mp_indi_basketball', 'OK');  
                            $table->Where('mp_indi_basketball', 'OK');  
                        }
                        if (in_array("mp_indi_golf", $request->minipack)){
                            $query->Where('mp_indi_golf', 'OK');  
                            $table->Where('mp_indi_golf', 'OK');  
                        }
                        if (in_array("mp_indi_japan", $request->minipack)){
                            $query->Where('mp_indi_japan', 'OK');  
                            $table->Where('mp_indi_japan', 'OK');  
                        }
                        if (in_array("mp_indi_jowo", $request->minipack)){
                            $query->Where('mp_indi_jowo', 'OK');  
                            $table->Where('mp_indi_jowo', 'OK');  
                        }
                        if (in_array("mp_indi_kids", $request->minipack)){
                            $query->Where('mp_indi_kids', 'OK');  
                            $table->Where('mp_indi_kids', 'OK');  
                        }
                        if (in_array("mp_indi_kids_bright", $request->minipack)){
                            $query->Where('mp_indi_kids_bright', 'OK');  
                            $table->Where('mp_indi_kids_bright', 'OK');  
                        }
                        if (in_array("mp_indi_kids_fun", $request->minipack)){
                            $query->Where('mp_indi_kids_fun', 'OK');  
                            $table->Where('mp_indi_kids_fun', 'OK');  
                        }
                        if (in_array("mp_indi_kids_joy", $request->minipack)){
                            $query->Where('mp_indi_kids_joy', 'OK');  
                            $table->Where('mp_indi_kids_joy', 'OK');  
                        }
                        if (in_array("mp_indi_kids_lite", $request->minipack)){
                            $query->Where('mp_indi_kids_lite', 'OK');  
                            $table->Where('mp_indi_kids_lite', 'OK');  
                        }
                        if (in_array("mp_indi_korea", $request->minipack)){
                            $query->Where('mp_indi_korea', 'OK');  
                            $table->Where('mp_indi_korea', 'OK');  
                        }
                        if (in_array("mp_indi_movie_1", $request->minipack)){
                            $query->Where('mp_indi_movie_1', 'OK');  
                            $table->Where('mp_indi_movie_1', 'OK');  
                        }
                        if (in_array("mp_indi_movie_1_lite", $request->minipack)){
                            $query->Where('mp_indi_movie_1_lite', 'OK');  
                            $table->Where('mp_indi_movie_1_lite', 'OK');  
                        }
                        if (in_array("mp_indi_movie_2", $request->minipack)){
                            $query->Where('mp_indi_movie_2', 'OK');  
                            $table->Where('mp_indi_movie_2', 'OK');  
                        }
                        if (in_array("mp_indi_news", $request->minipack)){
                            $query->Where('mp_indi_news', 'OK');
                            $table->Where('mp_indi_news', 'OK');  
                        }
                        if (in_array("mp_indi_sport_2", $request->minipack)){
                            $query->Where('mp_indi_sport_2', 'OK');  
                            $table->Where('mp_indi_sport_2', 'OK');  
                        }
                        if (in_array("mp_indi_sport_2", $request->minipack)){
                            $query->Where('mp_indi_sport_2', 'OK');  
                            $table->Where('mp_indi_sport_2', 'OK');  
                        }
                        if (in_array("mp_indi_tainment_1", $request->minipack)){
                            $query->Where('mp_indi_tainment_1', 'OK');  
                            $table->Where('mp_indi_tainment_1', 'OK');  
                        }
                        if (in_array("mp_konser", $request->minipack)){
                            $query->Where('mp_konser', 'OK');  
                            $table->Where('mp_konser', 'OK');  
                        }
                        if (in_array("ms_sport", $request->minipack)){
                            $query->Where('ms_sport', 'OK');  
                            $table->Where('ms_sport', 'OK');  
                        }
                    }
                    if(count($request->minipack) > 1)
                    {
                        $query->Where(function ($query) use ($request){
                            if (in_array("mp_combo_sport", $request->minipack)){
                                $query->orWhere('mp_combo_sport', 'OK');                                  
                            }
                            if (in_array("mp_dynasti_2", $request->minipack)){
                                $query->orWhere('mp_dynasti_2', 'OK');                                  
                            }
                            if (in_array("mp_essential", $request->minipack)){
                                $query->orWhere('mp_essential', 'OK');                                  
                            }
                            if (in_array("mp_extra_hd", $request->minipack)){
                                $query->orWhere('mp_extra_hd', 'OK');                                  
                            }
                            if (in_array("mp_indi_basketball", $request->minipack)){
                                $query->orWhere('mp_indi_basketball', 'OK');                                  
                            }
                            if (in_array("mp_indi_golf", $request->minipack)){
                                $query->orWhere('mp_indi_golf', 'OK');                                  
                            }
                            if (in_array("mp_indi_japan", $request->minipack)){
                                $query->orWhere('mp_indi_japan', 'OK');                                  
                            }
                            if (in_array("mp_indi_jowo", $request->minipack)){
                                $query->orWhere('mp_indi_jowo', 'OK');                                  
                            }
                            if (in_array("mp_indi_kids", $request->minipack)){
                                $query->orWhere('mp_indi_kids', 'OK');                                  
                            }
                            if (in_array("mp_indi_kids_bright", $request->minipack)){
                                $query->orWhere('mp_indi_kids_bright', 'OK');                                  
                            }
                            if (in_array("mp_indi_kids_fun", $request->minipack)){
                                $query->orWhere('mp_indi_kids_fun', 'OK');                                  
                            }
                            if (in_array("mp_indi_kids_joy", $request->minipack)){
                                $query->orWhere('mp_indi_kids_joy', 'OK');                                  
                            }
                            if (in_array("mp_indi_kids_lite", $request->minipack)){
                                $query->orWhere('mp_indi_kids_lite', 'OK');                                  
                            }
                            if (in_array("mp_indi_korea", $request->minipack)){
                                $query->orWhere('mp_indi_korea', 'OK');                                  
                            }
                            if (in_array("mp_indi_movie_1", $request->minipack)){
                                $query->orWhere('mp_indi_movie_1', 'OK');                                  
                            }
                            if (in_array("mp_indi_movie_1_lite", $request->minipack)){
                                $query->orWhere('mp_indi_movie_1_lite', 'OK');                                  
                            }
                            if (in_array("mp_indi_movie_2", $request->minipack)){
                                $query->orWhere('mp_indi_movie_2', 'OK');                                  
                            }
                            if (in_array("mp_indi_news", $request->minipack)){
                                $query->orWhere('mp_indi_news', 'OK');                                  
                            }
                            if (in_array("mp_indi_sport_2", $request->minipack)){
                                $query->orWhere('mp_indi_sport_2', 'OK');                                  
                            }
                            if (in_array("mp_indi_sport_2", $request->minipack)){
                                $query->orWhere('mp_indi_sport_2', 'OK');                                  
                            }
                            if (in_array("mp_indi_tainment_1", $request->minipack)){
                                $query->orWhere('mp_indi_tainment_1', 'OK');                                  
                            }
                            if (in_array("mp_konser", $request->minipack)){
                                $query->orWhere('mp_konser', 'OK');                                  
                            }
                            if (in_array("ms_sport", $request->minipack)){
                                $query->orWhere('ms_sport', 'OK');                                  
                            } 
                        });
                        $table->Where(function ($table) use ($request){
                            if (in_array("mp_combo_sport", $request->minipack)){                                
                                $table->orWhere('mp_combo_sport', 'OK');  
                            }
                            if (in_array("mp_dynasti_2", $request->minipack)){                                
                                $table->orWhere('mp_dynasti_2', 'OK');  
                            }
                            if (in_array("mp_essential", $request->minipack)){                                
                                $table->orWhere('mp_essential', 'OK');  
                            }
                            if (in_array("mp_extra_hd", $request->minipack)){                                
                                $table->orWhere('mp_extra_hd', 'OK');  
                            }
                            if (in_array("mp_indi_basketball", $request->minipack)){                                
                                $table->orWhere('mp_indi_basketball', 'OK');  
                            }
                            if (in_array("mp_indi_golf", $request->minipack)){                                
                                $table->orWhere('mp_indi_golf', 'OK');  
                            }
                            if (in_array("mp_indi_japan", $request->minipack)){                                
                                $table->orWhere('mp_indi_japan', 'OK');  
                            }
                            if (in_array("mp_indi_jowo", $request->minipack)){                                
                                $table->orWhere('mp_indi_jowo', 'OK');  
                            }
                            if (in_array("mp_indi_kids", $request->minipack)){                                
                                $table->orWhere('mp_indi_kids', 'OK');  
                            }
                            if (in_array("mp_indi_kids_bright", $request->minipack)){                                
                                $table->orWhere('mp_indi_kids_bright', 'OK');  
                            }
                            if (in_array("mp_indi_kids_fun", $request->minipack)){                                
                                $table->orWhere('mp_indi_kids_fun', 'OK');  
                            }
                            if (in_array("mp_indi_kids_joy", $request->minipack)){                                
                                $table->orWhere('mp_indi_kids_joy', 'OK');  
                            }
                            if (in_array("mp_indi_kids_lite", $request->minipack)){                                
                                $table->orWhere('mp_indi_kids_lite', 'OK');  
                            }
                            if (in_array("mp_indi_korea", $request->minipack)){                                
                                $table->orWhere('mp_indi_korea', 'OK');  
                            }
                            if (in_array("mp_indi_movie_1", $request->minipack)){                                
                                $table->orWhere('mp_indi_movie_1', 'OK');  
                            }
                            if (in_array("mp_indi_movie_1_lite", $request->minipack)){                                
                                $table->orWhere('mp_indi_movie_1_lite', 'OK');  
                            }
                            if (in_array("mp_indi_movie_2", $request->minipack)){                                
                                $table->orWhere('mp_indi_movie_2', 'OK');  
                            }
                            if (in_array("mp_indi_news", $request->minipack)){                                
                                $table->orWhere('mp_indi_news', 'OK');  
                            }
                            if (in_array("mp_indi_sport_2", $request->minipack)){                                
                                $table->orWhere('mp_indi_sport_2', 'OK');  
                            }
                            if (in_array("mp_indi_sport_2", $request->minipack)){                                
                                $table->orWhere('mp_indi_sport_2', 'OK');  
                            }
                            if (in_array("mp_indi_tainment_1", $request->minipack)){                                
                                $table->orWhere('mp_indi_tainment_1', 'OK');  
                            }
                            if (in_array("mp_konser", $request->minipack)){                                
                                $table->orWhere('mp_konser', 'OK');  
                            }
                            if (in_array("ms_sport", $request->minipack)){                                
                                $table->orWhere('ms_sport', 'OK');  
                            } 
                        });
                    }
                }  
                if($request->orderActivity)
                {   
                    if(count($request->orderActivity) == 1)
                    {
                        if (in_array("COMPLETED", $request->orderActivity)){
                            $query->where(function ($query){
                                $query->where('orderactivities_status', 'LIKE', '%COMPLETE%')
                                ->orWhereNull('orderactivities_status');
                            });   
                            $table->where(function ($table){
                                $table->where('orderactivities_status', 'LIKE', '%COMPLETE%')
                                ->orWhereNull('orderactivities_status');
                            });                                                     
                        }
                        if (in_array("IN PROGRESS", $request->orderActivity)){
                            $query->Where('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');      
                            $table->Where('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');                              

                        }                      
                    }
                    if(count($request->orderActivity) > 1)
                    {
                        $query->Where(function ($query) use ($request){
                            if (in_array("COMPLETED", $request->orderActivity)){
                                $query->orWhere(function ($query){
                                    $query->orWhere('orderactivities_status', 'LIKE', '%COMPLETE%')
                                    ->orWhereNull('orderactivities_status');
                                });                                
                            }
                            if (in_array("IN PROGRESS", $request->orderActivity)){
                                $query->orWhere('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');                                
                            }  
                        }); 
                        $table->Where(function ($table) use ($request){
                            if (in_array("COMPLETED", $request->orderActivity)){                               
                                $table->orWhere(function ($table){
                                    $table->orWhere('orderactivities_status', 'LIKE', '%COMPLETE%')
                                    ->orWhereNull('orderactivities_status');
                                });                              
                            }
                            if (in_array("IN PROGRESS", $request->orderActivity)){                                
                                $table->orWhere('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');                              
                            }  
                        });                        
                    }
                }  
                if($request->revenue)
                {      
                    if(count($request->revenue) == 1)
                    {
                        if (in_array("Platinum", $request->revenue)) {
                            $query->Where('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);                                                        ;                            
                            $table->Where('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);                                                        ;                            
                        }  
                        if (in_array("Gold", $request->revenue)) {
                            $query->where('revenue_trems', '>=', '500000')->where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);;                              
                            $table->where('revenue_trems', '>=', '500000')->where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);;                              
                        }  
                        if (in_array("Silver", $request->revenue)) {
                            $query->where('revenue_trems', '>=', '300000')->where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);;                              
                            $table->where('revenue_trems', '>=', '300000')->where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);;                              
                        }  
                        if (in_array("Reguler", $request->revenue)) {
                            $query->where('revenue_trems', '>=', '0')->where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);;                              
                            $table->where('revenue_trems', '>=', '0')->where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);;                              
                        } 
                        if (in_array("Unbill", $request->revenue)) {
                            $query->Where(function ($query){
                                $query->Where('revenue_trems', '<', '0')
                                ->orWhereNull('revenue_trems');
                            });   
                            $table->Where(function ($table){
                                $table->Where('revenue_trems', '<', '0')
                                ->orWhereNull('revenue_trems');
                            });                               
                        }
                    }
                    if(count($request->revenue) > 1)
                    {
                        $query->Where(function ($query) use ($request){
                            if (in_array("Platinum", $request->revenue)) {
                                $query->orWhere('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);                                                        
                            } 
                            if (in_array("Gold", $request->revenue)) {
                                $query->orWhere('revenue_trems', '>=', '500000')->Where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);                                                          
                            }  
                            if (in_array("Silver", $request->revenue)) {
                                $query->orWhere('revenue_trems', '>=', '300000')->Where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);                                                          
                            }  
                            if (in_array("Reguler", $request->revenue)) {
                                $query->orWhere('revenue_trems', '>=', '0')->Where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);                                                          
                            } 
                            if (in_array("Unbill", $request->revenue)) {
                                $query->orWhere(function ($query){
                                    $query->orWhere('revenue_trems', '<', '0')
                                    ->orWhereNull('revenue_trems');
                                });                                                               
                            }
                        }); 
                        $table->Where(function ($table) use ($request){
                            if (in_array("Platinum", $request->revenue)) {                                
                                $table->orWhere('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);                            
                            } 
                            if (in_array("Gold", $request->revenue)) {                                
                                $table->orWhere('revenue_trems', '>=', '500000')->Where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);                              
                            }  
                            if (in_array("Silver", $request->revenue)) {                                
                                $table->orWhere('revenue_trems', '>=', '300000')->Where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);                              
                            }  
                            if (in_array("Reguler", $request->revenue)) {                                
                                $table->orWhere('revenue_trems', '>=', '0')->Where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);                              
                            } 
                            if (in_array("Unbill", $request->revenue)) {                                
                                $table->orWhere(function ($table){
                                    $table->orWhere('revenue_trems', '<', '0')
                                    ->orWhereNull('revenue_trems');
                                });                              
                            }
                        }); 
                    }       
                }
                if($request->speed)
                {   
                    if(count($request->speed) == 1)
                    {
                        if (in_array("Kurang dari 10 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf','>=',0)->Where('speed_pcrf','<',10240);
                            $table->Where('speed_pcrf','>=',0)->Where('speed_pcrf','<',10240);
                        }
                        if (in_array("10 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf', 10240);                            
                            $table->Where('speed_pcrf', 10240);                            
                        }
                        if (in_array("20 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf', 20480);                            
                            $table->Where('speed_pcrf', 20480);                            
                        }
                        if (in_array("30 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf', 30720);                            
                            $table->Where('speed_pcrf', 30720);                            
                        }
                        if (in_array("40 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf', 40960);                            
                            $table->Where('speed_pcrf', 40960);                            
                        }
                        if (in_array("50 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf', 51200);                            
                            $table->Where('speed_pcrf', 51200);                            
                        }
                        if (in_array("100 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf', 102400);                            
                            $table->Where('speed_pcrf', 102400);                            
                        }
                        if (in_array("Lebih dari 100 Mbps", $request->speed)) {
                            $query->Where('speed_pcrf','>', 102400);                            
                            $table->Where('speed_pcrf','>', 102400);                            
                        }
                        if (in_array("NULL", $request->speed)) {
                            $query->Where(function ($query){
                                $query->WhereNull('speed_pcrf');
                            });
                            $query->Where(function ($table){
                                $table->WhereNull('speed_pcrf');
                            });                             
                        }
                    }
                    if(count($request->speed) > 1)
                    {
                        $query->Where(function ($query) use ($request){
                            if (in_array("Kurang dari 10 Mbps", $request->speed)) {
                                $query->orWhere(function ($query){
                                    $query->Where('speed_pcrf','>=',0)
                                    ->Where('speed_pcrf','<', 10240);
                                });                               
                            }
                            if (in_array("10 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf', 10240);                                                            
                            }
                            if (in_array("20 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf', 20480);                                                            
                            }
                            if (in_array("30 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf', 30720);                                                            
                            }
                            if (in_array("40 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf', 40960);                                                            
                            }
                            if (in_array("50 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf', 51200);                                                            
                            }
                            if (in_array("100 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf', 102400);                                                            
                            }
                            if (in_array("Lebih dari 100 Mbps", $request->speed)) {
                                $query->orWhere('speed_pcrf','>', 102400);                                                            
                            }
                            if (in_array("NULL", $request->speed)) {
                                $query->orWhere(function ($query){
                                    $query->orWhereNull('speed_pcrf');
                                });                                                             
                            }
                        });
                        $table->Where(function ($table) use ($request){
                            if (in_array("Kurang dari 10 Mbps", $request->speed)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('speed_pcrf','>=',0)
                                    ->Where('speed_pcrf','<', 10240);
                                });
                            }
                            if (in_array("10 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf', 10240);                            
                            }
                            if (in_array("20 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf', 20480);                            
                            }
                            if (in_array("30 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf', 30720);                            
                            }
                            if (in_array("40 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf', 40960);                            
                            }
                            if (in_array("50 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf', 51200);                            
                            }
                            if (in_array("100 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf', 102400);                            
                            }
                            if (in_array("Lebih dari 100 Mbps", $request->speed)) {                                
                                $table->orWhere('speed_pcrf','>', 102400);                            
                            }
                            if (in_array("NULL", $request->speed)) {                                
                                $table->orWhere(function ($table){
                                    $table->orWhereNull('speed_pcrf');
                                });                             
                            }
                        });
                    }
                } 
                if($request->usia)
                {   
                    if(count($request->usia) == 1)
                    {
                        if (in_array("1 sampai 3 Bln", $request->usia)) {
                            $query->Where('usia_ps','>=',1)->Where('usia_ps','<=',3);
                            $table->Where('usia_ps','>=',1)->Where('usia_ps','<=',3);
                        }
                        if (in_array("4 sampai 6 Bln", $request->usia)) {
                            $query->Where('usia_ps','>=',4)->Where('usia_ps','<=',6);
                            $table->Where('usia_ps','>=',4)->Where('usia_ps','<=',6);
                        }
                        if (in_array("7 sampai 12 Bln", $request->usia)) {
                            $query->Where('usia_ps','>=',7)->Where('usia_ps','<=',12);
                            $table->Where('usia_ps','>=',7)->Where('usia_ps','<=',12);
                        }
                        if (in_array("1 sampai 2 Thn", $request->usia)) {
                            $query->Where('usia_ps','>=',1)->Where('usia_ps','<=',24);
                            $table->Where('usia_ps','>=',1)->Where('usia_ps','<=',24);
                        }
                        if (in_array("Lebih dari 2 Thn", $request->usia)) {
                            $query->Where('usia_ps','>',24);
                            $table->Where('usia_ps','>',24);
                        }
                    }
                    if(count($request->usia) > 1)                    
                    {
                        $query->Where(function ($query) use ($request){
                            if (in_array("1 sampai 3 Bln", $request->usia)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usia_ps','>=',1)->Where('usia_ps','<=',3);
                                });                                
                            }
                            if (in_array("4 sampai 6 Bln", $request->usia)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usia_ps','>=',4)->Where('usia_ps','<=',6);
                                });                                 
                            }
                            if (in_array("7 sampai 12 Bln", $request->usia)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usia_ps','>=',7)->Where('usia_ps','<=',12);
                                });                               
                            }
                            if (in_array("1 sampai 2 Thn", $request->usia)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usia_ps','>=',12)->Where('usia_ps','<=',24);
                                });                                
                            }
                            if (in_array("Lebih dari 2 Thn", $request->usia)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usia_ps','>',24);
                                });                                
                            }
                        });
                        $table->Where(function ($table) use ($request){
                            if (in_array("1 sampai 3 Bln", $request->usia)) {                               
                                $table->orWhere(function ($table){
                                    $table->Where('usia_ps','>=',1)->Where('usia_ps','<=',3);
                                }); 
                            }
                            if (in_array("4 sampai 6 Bln", $request->usia)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usia_ps','>=',4)->Where('usia_ps','<=',6);
                                }); 
                            }
                            if (in_array("7 sampai 12 Bln", $request->usia)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usia_ps','>=',7)->Where('usia_ps','<=',12);
                                });
                            }
                            if (in_array("1 sampai 2 Thn", $request->usia)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usia_ps','>=',12)->Where('usia_ps','<=',24);
                                });
                            }
                            if (in_array("Lebih dari 2 Thn", $request->usia)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usia_ps','>',24);
                                });
                            }
                        });
                    }
                } 
                if($request->lcat)
                {                                                                             
                    $query->WhereIn('linecats_item_id', $request->lcat);  
                    $table->WhereIn('linecats_item_id', $request->lcat);
                }    
                if($request->ihsmart)
                {   
                    if(count($request->ihsmart) == 1)
                    {                        
                        if (in_array("Ada", $request->ihsmart)){
                            $query->whereNotNull('ih_smart');                                                         
                            $table->whereNotNull('ih_smart');                                                         
                        }
                        if (in_array("Tidak Ada", $request->ihsmart)){
                            $query->whereNull('ih_smart');                              
                            $table->whereNull('ih_smart');                              
                        }    
                    }
                    if(count($request->ihsmart) > 1)
                    {                        
                        $query->Where(function ($query) use ($request){                           
                            if (in_array("Ada", $request->ihsmart)) {
                                $query->orWhere(function ($query){
                                    $query->whereNotNull('ih_smart');                                                         
                                });                                 
                            }
                            if (in_array("Tidak Ada", $request->ihsmart)) {
                                $query->orWhere(function ($query){
                                    $query->whereNull('ih_smart');                              
                                });                                
                            }                           
                        });
                        $table->Where(function ($table) use ($request){                           
                            if (in_array("Ada", $request->ihsmart)) {                                
                                $table->orWhere(function ($table){
                                    $table->whereNotNull('ih_smart');                                                         
                                }); 
                            }
                            if (in_array("Tidak Ada", $request->ihsmart)) {                                
                                $table->orWhere(function ($table){
                                    $table->whereNull('ih_smart');                              
                                });
                            }                           
                        });
                    }
                } 
                if($request->unspec)
                {                       
                    if(count($request->unspec) == 1)
                    {                        
                        if (in_array("Spec", $request->unspec)) {
                            $query->Where('alpro_rxpoweronu','>',-25);
                            $table->Where('alpro_rxpoweronu','>',-25);
                        }
                        if (in_array("Underspec", $request->unspec)) {
                            $query->Where('alpro_rxpoweronu','<=',-25);
                            $table->Where('alpro_rxpoweronu','<=',-25);
                        }
                        if (in_array("Not Online", $request->unspec)) {
                            $query->whereNull('alpro_rxpoweronu');                              
                            $table->whereNull('alpro_rxpoweronu');                              
                        }  
                    }
                    if(count($request->unspec) > 1)
                    {                       
                        $query->Where(function ($query) use ($request) {
                            if (in_array("Spec", $request->unspec)) {
                                $query->orWhere(function ($query){
                                    $query->Where('alpro_rxpoweronu','>',-25);
                                });                                
                            }
                            if (in_array("Underspec", $request->unspec)) {
                                $query->orWhere(function ($query){
                                    $query->Where('alpro_rxpoweronu','<=',-25);
                                });                                 
                            }
                            if (in_array("Not Online", $request->unspec)) {
                                $query->orWhere(function ($query){
                                    $query->whereNull('alpro_rxpoweronu');                             
                                });                                 
                            }
                        });
                        $table->Where(function ($table) use ($request) {
                            if (in_array("Spec", $request->unspec)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('alpro_rxpoweronu','>',-25);
                                });
                            }
                            if (in_array("Underspec", $request->unspec)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('alpro_rxpoweronu','<=',-25);
                                });
                            }
                            if (in_array("Not Online", $request->unspec)) {                                
                                $table->orWhere(function ($table){
                                    $table->whereNull('alpro_rxpoweronu');                             
                                });
                            }
                        });
                    }
                }
                if($request->usageinet){
                    if(count($request->usageinet) == 1)
                    {
                        if (in_array("0 sampai 500 GB", $request->usageinet)) {
                            $query->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);
                            $table->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);
                        }
                        if (in_array("501 sampai 5000 GB", $request->usageinet)) {
                            $query->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);
                            $table->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);
                        }
                        if (in_array("5001 sampai 10000 GB", $request->usageinet)) {
                            $query->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);
                            $table->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);
                        }                        
                        if (in_array("Lebih dari 10000 GB", $request->usageinet)) {
                            $query->Where('usage_inet_last_month','>',10000);
                            $table->Where('usage_inet_last_month','>',10000);
                        }
                    }
                    if(count($request->usageinet) > 1)
                    {                        
                        $query->Where(function ($query) use ($request){
                            if (in_array("0 sampai 500 GB", $request->usageinet)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);
                                });                                 
                            }
                            if (in_array("501 sampai 5000 GB", $request->usageinet)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);
                                });                                 
                            }
                            if (in_array("5001 sampai 10000 GB", $request->usageinet)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);
                                });                                
                            }                           
                            if (in_array("Lebih dari 10000 GB", $request->usageinet)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_inet_last_month','>',10000);
                                });                                
                            }
                        });
                        $table->Where(function ($table) use ($request){
                            if (in_array("0 sampai 500 GB", $request->usageinet)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);
                                }); 
                            }
                            if (in_array("501 sampai 5000 GB", $request->usageinet)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);
                                }); 
                            }
                            if (in_array("5001 sampai 10000 GB", $request->usageinet)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);
                                });
                            }                           
                            if (in_array("Lebih dari 10000 GB", $request->usageinet)) {                                
                                $table->orWhere(function ($table){
                                    $table->Where('usage_inet_last_month','>',10000);
                                });
                            }
                        });
                    }
                }
                if($request->usagetv){
                    if(count($request->usagetv) == 1)
                    {
                        if (in_array("1 sampai 10 jam", $request->usagetv)) {
                            $query->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);
                            $table->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);
                        }
                        if (in_array("11 sampai 20 jam", $request->usagetv)) {
                            $query->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);
                            $table->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);
                        }
                        if (in_array("21 sampai 30 jam", $request->usagetv)) {
                            $query->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);
                            $table->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);
                        }  
                        if (in_array("31 sampai 40 jam", $request->usagetv)) {
                            $query->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                            $table->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                        }                        
                        if (in_array("Lebih dari 40 jam", $request->usagetv)) {
                            $query->Where('usage_tv_last_month','>',40);
                            $table->Where('usage_tv_last_month','>',40);
                        }
                    }
                    if(count($request->usagetv) > 1)
                    {                        
                        $query->Where(function ($query) use ($request){
                            if (in_array("1 sampai 10 jam", $request->usagetv)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);
                                });                                 
                            }
                            if (in_array("11 sampai 20 jam", $request->usagetv)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);
                                });                                 
                            }
                            if (in_array("21 sampai 30 jam", $request->usagetv)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);
                                });                                
                            }  
                            if (in_array("31 sampai 40 jam", $request->usagetv)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                                });                                
                            }                           
                            if (in_array("Lebih dari 40 jam", $request->usagetv)) {
                                $query->orWhere(function ($query){
                                    $query->Where('usage_tv_last_month','>',40);
                                });                                
                            }
                        });
                        $table->Where(function ($table) use ($request){
                            if (in_array("1 sampai 10 jam", $request->usagetv)) {
                                $table->orWhere(function ($table){
                                    $table->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);
                                });                                 
                            }
                            if (in_array("11 sampai 20 jam", $request->usagetv)) {
                                $table->orWhere(function ($table){
                                    $table->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);
                                });                                 
                            }
                            if (in_array("21 sampai 30 jam", $request->usagetv)) {
                                $table->orWhere(function ($table){
                                    $table->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);
                                });                                
                            }  
                            if (in_array("31 sampai 40 jam", $request->usagetv)) {
                                $table->orWhere(function ($table){
                                    $table->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                                });                                
                            }                           
                            if (in_array("Lebih dari 40 jam", $request->usagetv)) {
                                $table->orWhere(function ($table){
                                    $table->Where('usage_tv_last_month','>',40);
                                });                                
                            }
                        });
                    }
                }
                
                $data = [
                    'customers' => $query->where('root_status', 'Active')->where('cprod', '11')->where('linecats_item_id', '<', '400')->count(),
                    'email' => $query->where('root_status', 'Active')->where('cprod', '11')->where('linecats_item_id', '<', '400')->where('email_myih', '!=', null)->count(),
                    'mobiles' => $query->where('root_status', 'Active')->where('cprod', '11')->where('linecats_item_id', '<', '400')->where('no_hp', '!=', null)->count(),
                    'manajemen' => $table = $table->select(array(
                        'witel_str as nama_witel',
                        DB::raw("SUM(CASE WHEN plblcl_trems='PL' THEN 1 ELSE 0 END) as PL"),
                        DB::raw("SUM(CASE WHEN plblcl_trems='BL' THEN 1 ELSE 0 END) as BL"),
                        DB::raw("SUM(CASE WHEN plblcl_trems='CL' THEN 1 ELSE 0 END) as CL"),
                        DB::raw("SUM(CASE WHEN plblcl_trems='GL' THEN 1 ELSE 0 END) as GL"),
                        DB::raw("SUM(CASE WHEN (usia_ps >= 1 AND usia_ps <= 3) THEN 1 ELSE 0 END) as UB1"),                      
                        DB::raw("SUM(CASE WHEN (usia_ps >= 4 AND usia_ps <= 6) THEN 1 ELSE 0 END) as UB2"),
                        DB::raw("SUM(CASE WHEN (usia_ps >= 7 AND usia_ps <= 12) THEN 1 ELSE 0 END) as UB3"),
                        DB::raw("SUM(CASE WHEN (usia_ps >= 12 AND usia_ps <= 24) THEN 1 ELSE 0 END) as UB4"),
                        DB::raw("SUM(CASE WHEN usia_ps >= 24 THEN 1 ELSE 0 END) as UB5")
                    ))->where('root_status','Active')->where('cprod','11')->where('linecats_item_id', '<', '400')->groupBy('nama_witel')->get(),
                ];
            }
            return response()->json($data);         
        }
        $witels = Witel::get(['id', 'nama_witel']);
        $indihome = MasterDataTreg::select('1p_2p_3p as indihome')->where('root_status', 'Active')->groupBy('indihome')->get();
        $customer = MasterDataTreg::select('plblcl_trems')->where('root_status', 'Active')->groupBy('plblcl_trems')->get();
        $useetv = MasterDataTreg::select('jenis_useetv')->where('root_status', 'Active')->groupBy('jenis_useetv')->get();
        $gangguan = MasterDataTreg::select('status_gangguan')->where('root_status', 'Active')->groupBy('status_gangguan')->get();
        $orderActivity = DB::connection('pg6')->table('cluster_orderactivities')->select('cluster_group')->groupBy('cluster_group')->orderBy('cluster_group', 'ASC')->get();
        $revenue = DB::connection('pg6')->table('cluster_rev')->select('cluster_rev')->groupBy('cluster_rev')->orderBy('cluster_rev', 'ASC')->get();
        $lcat = MasterDataTreg::select('linecats_item_id')->where('root_status', 'Active')->whereIn('linecats_item_id', ['100','201','202','203','204'])->groupBy('linecats_item_id')->get();
        $minipack = array('mp_combo_sport', 'mp_dynasti_2', 'mp_essential', 'mp_extra_hd', 'mp_indi_action', 'mp_indi_basketball', 
            'mp_indi_golf', 'mp_indi_japan', 'mp_indi_jowo', 'mp_indi_kids', 'mp_indi_kids_bright', 'mp_indi_kids_fun', 
            'mp_indi_kids_joy', 'mp_indi_kids_lite', 'mp_indi_korea', 'mp_indi_movie_1', 'mp_indi_movie_1_lite', 
            'mp_indi_movie_2', 'mp_indi_news', 'mp_indi_sport_2', 'mp_indi_tainment_1', 'mp_indi_tainment_2', 'mp_konser', 'mp_sport');  
        $speedpcrf = DB::connection('pg6')->table('cluster_speed_pcrf')->select('cluster_speed_pcrf')->groupBy('cluster_speed_pcrf','sort')->orderBy('sort', 'ASC')->get();
        $usia_ps = DB::connection('pg6')->table('cluster_usia_ps')->select('cluster_usia_ps')->groupBy('cluster_usia_ps','sort')->orderBy('sort', 'ASC')->get();
        $ihsmart = DB::connection('pg6')->table('cluster_ih_smart')->select('cluster_ih_smart')->groupBy('cluster_ih_smart')->get();
        $unspec = DB::connection('pg6')->table('cluster_unspec')->select('cluster_unspec')->groupBy('cluster_unspec','sort')->orderBy('sort', 'ASC')->get();
        $usageinet = DB::connection('pg6')->table('cluster_usage_inet')->select('cluster_usage_group',)->where('cluster_usage_group', '!=', null)->groupBy('cluster_usage_group','sort')->orderBy('sort', 'ASC')->get();
        $usagetv = DB::connection('pg6')->table('cluster_usage_tv')->select('cluster_usage_tv',)->where('cluster_usage_tv', '!=', null)->groupBy('cluster_usage_tv','sort')->orderBy('sort', 'ASC')->get();
        
        return view ('admin.prospect.index',compact('witels','indihome','customer',
        'useetv','gangguan','minipack','orderActivity','revenue','lcat','speedpcrf',
        'usia_ps','ihsmart','unspec','usageinet','usagetv'));
    }

    public function downloadexcel(Request $request)
    {
        $value = collect($request->session()->get('params'));
<<<<<<< HEAD
        $datatreg = MasterData::select('notel','nd_reference', 'witel_str', 'datel_str', 'abrv_repart', 'nper', 'payment_date', 'l_bank', 'jenis_bayar', 'speed_inet', 'speed_pcrf', 'tarif_inet', 'startdate_inet', 'paket_inet',
            'caps', 'wms', 'homewifi_brite', 'movin_seamless','wifi_ext','minipack','ih_smart','plc', 'nama_pelanggan_bynoss', 'no_hp', 'email_myih', '1p_2p_3p as indihome', 
            'linecats_item_id', 'revenue_trems', 'valid_from', 'usage_voice', 'usage_inet', 'usage_tv', 'usia_ps', 'alamat_gabungan', 'jenis_useetv', 'nohp_pcf','packet_inet_pcrf','speed_pcrf_real','revenue_pots','segmen_hvc','odp_name','kwadran_indihome','kwadran_internet','is_ct0','per_ct0')->where('is_lis',1)
            ->where('cprod', '11')->where('root_status', 'Active')->where('linecats_item_id', '<', '400');
        if (isset($value['witel'])) 
=======
        // $datatreg = MasterDataTreg::select('notel','nd_reference', 'witel_str', 'datel_str', 'abrv_repart', 'nper', 'payment_date', 'l_bank', 'jenis_bayar', 'speed_inet', 'speed_pcrf', 'tarif_inet', 'startdate_inet', 'paket_inet',
        //     'caps', 'wms', 'homewifi_brite', 'movin_seamless','wifi_ext','minipack','ih_smart','plc', 'nama_pelanggan_bynoss', 'no_hp', 'email_myih', '1p_2p_3p as indihome',
        //     'linecats_item_id', 'revenue_trems', 'valid_from', 'usage_voice', 'usage_inet', 'usage_tv', 'usia_ps', 'alamat_gabungan', 'jenis_useetv', 'nohp_pcf')->where('is_lis',1)
        //     ->where('cprod', '11')->where('root_status', 'Active')->where('linecats_item_id', '<', '400');

        //ambil langsung dari MASTERDATATREG6
        $datatreg = MasterData::select('*')->where('lis_prm',1)->where('cprod', '11');
        if (isset($value['witel']))
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
        {
            $datatreg->whereIn('witel_str', $value['witel']);
        }
        if (isset($value['indihome'])) 
        {
<<<<<<< HEAD
            $datatreg->whereIn('1p_2p_3p', $value['indihome']);           
=======
            $datatreg->whereIn('1p_2p_3p', $value['indihome']);
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
        }
        if (isset($value['customer'])) 
        {
            $datatreg->whereIn('plblcl_trems', $value['customer']);
        }
        if (isset($value['useetv'])) 
        {
            $datatreg->whereIn('jenis_useetv', $value['useetv']);
            if (in_array(null, $value['useetv'])){
                $datatreg->orWhereNull('jenis_useetv');
            }
        }
        if (isset($value['gangguan'])) 
        {
            $datatreg->whereIn('status_gangguan', $value['gangguan']);
        }
        if(isset($value['minipack']))
        {                
            if(count($value['minipack']) == 1)
            {
                if (in_array("mp_combo_sport", $value['minipack'])){
<<<<<<< HEAD
                    $datatreg->Where('mp_combo_sport', 'OK');  
                }
                if (in_array("mp_dynasti_2", $value['minipack'])){
                    $datatreg->Where('mp_dynasti_2', 'OK');  
                }
                if (in_array("mp_essential", $value['minipack'])){
                    $datatreg->Where('mp_essential', 'OK');  
=======
                    $datatreg->Where('mp_combo_sport', 'OK');
                }
                if (in_array("mp_dynasti_2", $value['minipack'])){
                    $datatreg->Where('mp_dynasti_2', 'OK');
                }
                if (in_array("mp_essential", $value['minipack'])){
                    $datatreg->Where('mp_essential', 'OK');
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
                if (in_array("mp_extra_hd", $value['minipack'])){
                    $datatreg->Where('mp_extra_hd', 'OK');  
                }
                if (in_array("mp_indi_basketball", $value['minipack'])){
<<<<<<< HEAD
                    $datatreg->Where('mp_indi_basketball', 'OK');  
                }
                if (in_array("mp_indi_golf", $value['minipack'])){
                    $datatreg->Where('mp_indi_golf', 'OK');  
                }
                if (in_array("mp_indi_japan", $value['minipack'])){
                    $datatreg->Where('mp_indi_japan', 'OK');  
                }
                if (in_array("mp_indi_jowo", $value['minipack'])){
                    $datatreg->Where('mp_indi_jowo', 'OK');  
                }
                if (in_array("mp_indi_kids", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids', 'OK');  
                }
                if (in_array("mp_indi_kids_bright", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_bright', 'OK');  
                }
                if (in_array("mp_indi_kids_fun", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_fun', 'OK');  
                }
                if (in_array("mp_indi_kids_joy", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_joy', 'OK');  
                }
                if (in_array("mp_indi_kids_lite", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_lite', 'OK');  
                }
                if (in_array("mp_indi_korea", $value['minipack'])){
                    $datatreg->Where('mp_indi_korea', 'OK');  
                }
                if (in_array("mp_indi_movie_1", $value['minipack'])){
                    $datatreg->Where('mp_indi_movie_1', 'OK');  
                }
                if (in_array("mp_indi_movie_1_lite", $value['minipack'])){
                    $datatreg->Where('mp_indi_movie_1_lite', 'OK');  
                }
                if (in_array("mp_indi_movie_2", $value['minipack'])){
                    $datatreg->Where('mp_indi_movie_2', 'OK');  
                }
                if (in_array("mp_indi_news", $value['minipack'])){
                    $datatreg->Where('mp_indi_news', 'OK');  
                }
                if (in_array("mp_indi_sport_2", $value['minipack'])){
                    $datatreg->Where('mp_indi_sport_2', 'OK');  
                }
                if (in_array("mp_indi_sport_2", $value['minipack'])){
                    $datatreg->Where('mp_indi_sport_2', 'OK');  
                }
                if (in_array("mp_indi_tainment_1", $value['minipack'])){
                    $datatreg->Where('mp_indi_tainment_1', 'OK');  
                }
                if (in_array("mp_konser", $value['minipack'])){
                    $datatreg->Where('mp_konser', 'OK');  
                }
                if (in_array("ms_sport", $value['minipack'])){
                    $datatreg->Where('ms_sport', 'OK');  
=======
                    $datatreg->Where('mp_indi_basketball', 'OK');
                }
                if (in_array("mp_indi_golf", $value['minipack'])){
                    $datatreg->Where('mp_indi_golf', 'OK');
                }
                if (in_array("mp_indi_japan", $value['minipack'])){
                    $datatreg->Where('mp_indi_japan', 'OK');
                }
                if (in_array("mp_indi_jowo", $value['minipack'])){
                    $datatreg->Where('mp_indi_jowo', 'OK');
                }
                if (in_array("mp_indi_kids", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids', 'OK');
                }
                if (in_array("mp_indi_kids_bright", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_bright', 'OK');
                }
                if (in_array("mp_indi_kids_fun", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_fun', 'OK');
                }
                if (in_array("mp_indi_kids_joy", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_joy', 'OK');
                }
                if (in_array("mp_indi_kids_lite", $value['minipack'])){
                    $datatreg->Where('mp_indi_kids_lite', 'OK');
                }
                if (in_array("mp_indi_korea", $value['minipack'])){
                    $datatreg->Where('mp_indi_korea', 'OK');
                }
                if (in_array("mp_indi_movie_1", $value['minipack'])){
                    $datatreg->Where('mp_indi_movie_1', 'OK');
                }
                if (in_array("mp_indi_movie_1_lite", $value['minipack'])){
                    $datatreg->Where('mp_indi_movie_1_lite', 'OK');
                }
                if (in_array("mp_indi_movie_2", $value['minipack'])){
                    $datatreg->Where('mp_indi_movie_2', 'OK');
                }
                if (in_array("mp_indi_news", $value['minipack'])){
                    $datatreg->Where('mp_indi_news', 'OK');
                }
                if (in_array("mp_indi_sport_2", $value['minipack'])){
                    $datatreg->Where('mp_indi_sport_2', 'OK');
                }
                if (in_array("mp_indi_sport_2", $value['minipack'])){
                    $datatreg->Where('mp_indi_sport_2', 'OK');
                }
                if (in_array("mp_indi_tainment_1", $value['minipack'])){
                    $datatreg->Where('mp_indi_tainment_1', 'OK');
                }
                if (in_array("mp_konser", $value['minipack'])){
                    $datatreg->Where('mp_konser', 'OK');
                }
                if (in_array("ms_sport", $value['minipack'])){
                    $datatreg->Where('ms_sport', 'OK');
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
            }
            if(count($value['minipack']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("mp_combo_sport", $value['minipack'])){
<<<<<<< HEAD
                        $datatreg->orWhere('mp_combo_sport', 'OK');  
                    }
                    if (in_array("mp_dynasti_2", $value['minipack'])){
                        $datatreg->orWhere('mp_dynasti_2', 'OK');  
                    }
                    if (in_array("mp_essential", $value['minipack'])){
                        $datatreg->orWhere('mp_essential', 'OK');  
                    }
                    if (in_array("mp_extra_hd", $value['minipack'])){
                        $datatreg->orWhere('mp_extra_hd', 'OK');  
                    }
                    if (in_array("mp_indi_basketball", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_basketball', 'OK');  
                    }
                    if (in_array("mp_indi_golf", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_golf', 'OK');  
                    }
                    if (in_array("mp_indi_japan", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_japan', 'OK');  
                    }
                    if (in_array("mp_indi_jowo", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_jowo', 'OK');  
                    }
                    if (in_array("mp_indi_kids", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids', 'OK');  
                    }
                    if (in_array("mp_indi_kids_bright", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_bright', 'OK');  
                    }
                    if (in_array("mp_indi_kids_fun", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_fun', 'OK');  
                    }
                    if (in_array("mp_indi_kids_joy", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_joy', 'OK');  
                    }
                    if (in_array("mp_indi_kids_lite", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_lite', 'OK');  
                    }
                    if (in_array("mp_indi_korea", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_korea', 'OK');  
                    }
                    if (in_array("mp_indi_movie_1", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_movie_1', 'OK');  
                    }
                    if (in_array("mp_indi_movie_1_lite", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_movie_1_lite', 'OK');  
                    }
                    if (in_array("mp_indi_movie_2", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_movie_2', 'OK');  
                    }
                    if (in_array("mp_indi_news", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_news', 'OK');  
                    }
                    if (in_array("mp_indi_sport_2", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_sport_2', 'OK');  
                    }
                    if (in_array("mp_indi_sport_2", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_sport_2', 'OK');  
                    }
                    if (in_array("mp_indi_tainment_1", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_tainment_1', 'OK');  
                    }
                    if (in_array("mp_konser", $value['minipack'])){
                        $datatreg->orWhere('mp_konser', 'OK');  
                    }
                    if (in_array("ms_sport", $value['minipack'])){
                        $datatreg->orWhere('ms_sport', 'OK');  
                    } 
                }); 
=======
                        $datatreg->orWhere('mp_combo_sport', 'OK');
                    }
                    if (in_array("mp_dynasti_2", $value['minipack'])){
                        $datatreg->orWhere('mp_dynasti_2', 'OK');
                    }
                    if (in_array("mp_essential", $value['minipack'])){
                        $datatreg->orWhere('mp_essential', 'OK');
                    }
                    if (in_array("mp_extra_hd", $value['minipack'])){
                        $datatreg->orWhere('mp_extra_hd', 'OK');
                    }
                    if (in_array("mp_indi_basketball", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_basketball', 'OK');
                    }
                    if (in_array("mp_indi_golf", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_golf', 'OK');
                    }
                    if (in_array("mp_indi_japan", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_japan', 'OK');
                    }
                    if (in_array("mp_indi_jowo", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_jowo', 'OK');
                    }
                    if (in_array("mp_indi_kids", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids', 'OK');
                    }
                    if (in_array("mp_indi_kids_bright", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_bright', 'OK');
                    }
                    if (in_array("mp_indi_kids_fun", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_fun', 'OK');
                    }
                    if (in_array("mp_indi_kids_joy", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_joy', 'OK');
                    }
                    if (in_array("mp_indi_kids_lite", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_kids_lite', 'OK');
                    }
                    if (in_array("mp_indi_korea", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_korea', 'OK');
                    }
                    if (in_array("mp_indi_movie_1", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_movie_1', 'OK');
                    }
                    if (in_array("mp_indi_movie_1_lite", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_movie_1_lite', 'OK');
                    }
                    if (in_array("mp_indi_movie_2", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_movie_2', 'OK');
                    }
                    if (in_array("mp_indi_news", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_news', 'OK');
                    }
                    if (in_array("mp_indi_sport_2", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_sport_2', 'OK');
                    }
                    if (in_array("mp_indi_sport_2", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_sport_2', 'OK');
                    }
                    if (in_array("mp_indi_tainment_1", $value['minipack'])){
                        $datatreg->orWhere('mp_indi_tainment_1', 'OK');
                    }
                    if (in_array("mp_konser", $value['minipack'])){
                        $datatreg->orWhere('mp_konser', 'OK');
                    }
                    if (in_array("ms_sport", $value['minipack'])){
                        $datatreg->orWhere('ms_sport', 'OK');
                    }
                });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
            }
        }
        if(isset($value['orderActivity']))
        {   
            if(count($value['orderActivity']) == 1)
            {
                if (in_array("COMPLETED", $value['orderActivity'])){
                    $datatreg->where(function ($datatreg){
                        $datatreg->where('orderactivities_status', 'LIKE', '%COMPLETE%')
                        ->orWhereNull('orderactivities_status');
<<<<<<< HEAD
                    });                             
                }
                if (in_array("IN PROGRESS", $value['orderActivity'])){
                    $datatreg->Where('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');                              
                }    
=======
                    });
                }
                if (in_array("IN PROGRESS", $value['orderActivity'])){
                    $datatreg->Where('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');
                }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
            }
            if(count($value['orderActivity']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("COMPLETED", $value['orderActivity'])){
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->orWhere('orderactivities_status', 'LIKE', '%COMPLETE%')
                            ->orWhereNull('orderactivities_status');
<<<<<<< HEAD
                        });                             
                    }
                    if (in_array("IN PROGRESS", $value['orderActivity'])){
                        $datatreg->orWhere('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');                              
                    }  
                }); 
=======
                        });
                    }
                    if (in_array("IN PROGRESS", $value['orderActivity'])){
                        $datatreg->orWhere('orderactivities_status', 'NOT LIKE', '%COMPLETE%')->whereNotNull('orderactivities_status');
                    }
                });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
            }
        }  
        if(isset($value['revenue']))
        {      
            if(count($value['revenue']) == 1)
            {
                if (in_array("Platinum", $value['revenue'])) {
<<<<<<< HEAD
                    $datatreg->Where('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);                            
                }  
                if (in_array("Gold", $value['revenue'])) {
                    $datatreg->where('revenue_trems', '>=', '500000')->where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);                              
                }  
                if (in_array("Silver", $value['revenue'])) {
                    $datatreg->where('revenue_trems', '>=', '300000')->where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);                              
                }  
                if (in_array("Reguler", $value['revenue'])) {
                    $datatreg->where('revenue_trems', '>=', '0')->where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);                              
                } 
=======
                    $datatreg->Where('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);
                }
                if (in_array("Gold", $value['revenue'])) {
                    $datatreg->where('revenue_trems', '>=', '500000')->where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);
                }
                if (in_array("Silver", $value['revenue'])) {
                    $datatreg->where('revenue_trems', '>=', '300000')->where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);
                }
                if (in_array("Reguler", $value['revenue'])) {
                    $datatreg->where('revenue_trems', '>=', '0')->where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);
                }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                if (in_array("Unbill", $value['revenue'])) {
                    $datatreg->Where(function ($datatreg){
                        $datatreg->Where('revenue_trems', '<', '0')
                        ->orWhereNull('revenue_trems');
<<<<<<< HEAD
                    });                              
=======
                    });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
            }
            if(count($value['revenue']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("Platinum", $value['revenue'])) {
<<<<<<< HEAD
                        $datatreg->orWhere('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);                            
                    } 
                    if (in_array("Gold", $value['revenue'])) {
                        $datatreg->orWhere('revenue_trems', '>=', '500000')->Where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);                              
                    }  
                    if (in_array("Silver", $value['revenue'])) {
                        $datatreg->orWhere('revenue_trems', '>=', '300000')->Where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);                              
                    }  
                    if (in_array("Reguler", $value['revenue'])) {
                        $datatreg->orWhere('revenue_trems', '>=', '0')->Where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);                              
                    } 
=======
                        $datatreg->orWhere('revenue_trems', '>=', '700000')->where('usia_ps', '>', 3);
                    }
                    if (in_array("Gold", $value['revenue'])) {
                        $datatreg->orWhere('revenue_trems', '>=', '500000')->Where('revenue_trems', '<=', '699999')->where('usia_ps', '>', 18);
                    }
                    if (in_array("Silver", $value['revenue'])) {
                        $datatreg->orWhere('revenue_trems', '>=', '300000')->Where('revenue_trems', '<=', '499999')->where('usia_ps', '>', 18);
                    }
                    if (in_array("Reguler", $value['revenue'])) {
                        $datatreg->orWhere('revenue_trems', '>=', '0')->Where('revenue_trems', '<=', '299999')->where('usia_ps', '>', 18);
                    }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    if (in_array("Unbill", $value['revenue'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->orWhere('revenue_trems', '<', '0')
                            ->orWhereNull('revenue_trems');
<<<<<<< HEAD
                        });                              
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                }); 
            }       
        }
        if (isset($value['lcat'])) 
        {
            $datatreg->whereIn('linecats_item_id', $value['lcat']);
<<<<<<< HEAD
        }   
=======
        }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
        if(isset($value['speed']))
        {   
            if(count($value['speed']) == 1)
            {
                if (in_array("Kurang dari 10 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf','>=',0)->Where('speed_pcrf','<',10240);
                }
                if (in_array("10 Mbps", $value['speed'])) {
<<<<<<< HEAD
                    $datatreg->Where('speed_pcrf', 10240);                            
                }
                if (in_array("20 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 20480);                            
                }
                if (in_array("30 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 30720);                            
                }
                if (in_array("40 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 40960);                            
                }
                if (in_array("50 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 51200);                            
                }
                if (in_array("100 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 102400);                            
                }
                if (in_array("Lebih dari 100 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf','>', 102400);                            
=======
                    $datatreg->Where('speed_pcrf', 10240);
                }
                if (in_array("20 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 20480);
                }
                if (in_array("30 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 30720);
                }
                if (in_array("40 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 40960);
                }
                if (in_array("50 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 51200);
                }
                if (in_array("100 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf', 102400);
                }
                if (in_array("Lebih dari 100 Mbps", $value['speed'])) {
                    $datatreg->Where('speed_pcrf','>', 102400);
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
                if (in_array("NULL", $value['speed'])) {
                    $datatreg->Where(function ($datatreg){
                        $datatreg->WhereNull('speed_pcrf');
<<<<<<< HEAD
                    });                             
=======
                    });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
            }
            if(count($value['speed']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("Kurang dari 10 Mbps", $value['speed'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('speed_pcrf','>=',0)
                            ->Where('speed_pcrf','<', 10240);
                        });
                    }
                    if (in_array("10 Mbps", $value['speed'])) {
<<<<<<< HEAD
                        $datatreg->orWhere('speed_pcrf', 10240);                            
                    }
                    if (in_array("20 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 20480);                            
                    }
                    if (in_array("30 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 30720);                            
                    }
                    if (in_array("40 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 40960);                            
                    }
                    if (in_array("50 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 51200);                            
                    }
                    if (in_array("100 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 102400);                            
                    }
                    if (in_array("Lebih dari 100 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf','>', 102400);                            
=======
                        $datatreg->orWhere('speed_pcrf', 10240);
                    }
                    if (in_array("20 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 20480);
                    }
                    if (in_array("30 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 30720);
                    }
                    if (in_array("40 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 40960);
                    }
                    if (in_array("50 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 51200);
                    }
                    if (in_array("100 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf', 102400);
                    }
                    if (in_array("Lebih dari 100 Mbps", $value['speed'])) {
                        $datatreg->orWhere('speed_pcrf','>', 102400);
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("NULL", $value['speed'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->orWhereNull('speed_pcrf');
<<<<<<< HEAD
                        });                             
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                });
            }
        } 
        if(isset($value['usia']))
        {   
            if(count($value['usia']) == 1)
            {
                if (in_array("1 sampai 3 Bln", $value['usia'])) {
                    $datatreg->Where('usia_ps','>=',1)->Where('usia_ps','<=',3);
                }
                if (in_array("4 sampai 6 Bln", $value['usia'])) {
                    $datatreg->Where('usia_ps','>=',4)->Where('usia_ps','<=',6);
                }
                if (in_array("7 sampai 12 Bln", $value['usia'])) {
                    $datatreg->Where('usia_ps','>=',7)->Where('usia_ps','<=',12);
                }
                if (in_array("1 sampai 2 Thn", $value['usia'])) {
                    $datatreg->Where('usia_ps','>=',1)->Where('usia_ps','<=',24);
                }
                if (in_array("Lebih dari 2 Thn", $value['usia'])) {
                    $datatreg->Where('usia_ps','>',24);
                }
            }
            if(count($value['usia']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("1 sampai 3 Bln", $value['usia'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usia_ps','>=',1)->Where('usia_ps','<=',3);
<<<<<<< HEAD
                        }); 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("4 sampai 6 Bln", $value['usia'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usia_ps','>=',4)->Where('usia_ps','<=',6);
<<<<<<< HEAD
                        }); 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("7 sampai 12 Bln", $value['usia'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usia_ps','>=',7)->Where('usia_ps','<=',12);
                        });
                    }
                    if (in_array("1 sampai 2 Thn", $value['usia'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usia_ps','>=',1)->Where('usia_ps','<=',24);
                        });
                    }
                    if (in_array("Lebih dari 2 Thn", $value['usia'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usia_ps','>',24);
                        });
                    }
                });
            }
        } 
        if(isset($value['ihsmart']))
        {   
            if(count($value['ihsmart']) == 1)
            {
                if (in_array("Ada", $value['ihsmart'])){
                    $datatreg->whereNotNull('ih_smart');
<<<<<<< HEAD
                }  
                if (in_array("Tidak Ada", $value['ihsmart'])){
                    $datatreg->whereNull('ih_smart');
                }    
=======
                }
                if (in_array("Tidak Ada", $value['ihsmart'])){
                    $datatreg->whereNull('ih_smart');
                }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
            }
            if(count($value['ihsmart']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("Ada", $value['ihsmart'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->whereNotNull('ih_smart');
<<<<<<< HEAD
                        }); 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("Tidak Ada", $value['ihsmart'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->whereNull('ih_smart');
<<<<<<< HEAD
                        }); 
                    }                      
=======
                        });
                    }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                });
            }
        } 
        if(isset($value['unspec']))
        {   
            if(count($value['unspec']) == 1)
            {                   
                if (in_array("Spec", $value['unspec'])) {
                    $datatreg->Where('alpro_rxpoweronu','>',-25);
                }
                if (in_array("Underspec", $value['unspec'])) {
                    $datatreg->Where('alpro_rxpoweronu','<=',-25);
                }
                if (in_array("Not Online", $value['unspec'])) {
<<<<<<< HEAD
                    $datatreg->whereNull('alpro_rxpoweronu');                              
                }     
=======
                    $datatreg->whereNull('alpro_rxpoweronu');
                }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
            }
            if(count($value['unspec']) > 1)
            {
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("Spec", $value['unspec'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('alpro_rxpoweronu','>',-25);
<<<<<<< HEAD
                        }); 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("Underspec", $value['unspec'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('alpro_rxpoweronu','<=',-25);
<<<<<<< HEAD
                        }); 
                    } 
                    if (in_array("Not Online", $value['unspec'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->whereNull('alpro_rxpoweronu');                              
                        }); 
                    }                     
=======
                        });
                    }
                    if (in_array("Not Online", $value['unspec'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->whereNull('alpro_rxpoweronu');
                        });
                    }
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                });
            }
        } 
        if(isset($value['usageinet']))
        {
            if(count($value['usageinet']) == 1)
            {
                if (in_array("0 sampai 500 GB", $value['usageinet'])) {
<<<<<<< HEAD
                    $datatreg->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);                    
                }
                if (in_array("501 sampai 5000 GB", $value['usageinet'])) {
                    $datatreg->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);                    
                }
                if (in_array("5001 sampai 10000 GB", $value['usageinet'])) {
                    $datatreg->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);                    
                }                        
                if (in_array("Lebih dari 10000 GB", $value['usageinet'])) {
                    $datatreg->Where('usage_inet_last_month','>',10000);                    
=======
                    $datatreg->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);
                }
                if (in_array("501 sampai 5000 GB", $value['usageinet'])) {
                    $datatreg->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);
                }
                if (in_array("5001 sampai 10000 GB", $value['usageinet'])) {
                    $datatreg->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);
                }
                if (in_array("Lebih dari 10000 GB", $value['usageinet'])) {
                    $datatreg->Where('usage_inet_last_month','>',10000);
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
            }
            if(count($value['usageinet']) > 1)
            {                        
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("0 sampai 500 GB", $value['usageinet'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_inet_last_month','>=',0)->Where('usage_inet_last_month','<=',500);
<<<<<<< HEAD
                        });                                 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("501 sampai 5000 GB", $value['usageinet'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_inet_last_month','>=',501)->Where('usage_inet_last_month','<=',5000);
<<<<<<< HEAD
                        });                                 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("5001 sampai 10000 GB", $value['usageinet'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_inet_last_month','>=',5001)->Where('usage_inet_last_month','<=',10000);
<<<<<<< HEAD
                        });                                
                    }                           
                    if (in_array("Lebih dari 10000 GB", $value['usageinet'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_inet_last_month','>',10000);
                        });                                
=======
                        });
                    }
                    if (in_array("Lebih dari 10000 GB", $value['usageinet'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_inet_last_month','>',10000);
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                });               
            }
        }
        if(isset($value['usagetv']))
        {
            if(count($value['usagetv']) == 1)
            {
                if (in_array("1 sampai 10 jam", $value['usagetv'])) {
<<<<<<< HEAD
                    $datatreg->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);                    
                }
                if (in_array("11 sampai 20 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);                    
                }
                if (in_array("21 sampai 30 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);                    
                }  
                if (in_array("31 sampai 40 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);                    
                }                        
                if (in_array("Lebih dari 40 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>',40);                    
=======
                    $datatreg->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);
                }
                if (in_array("11 sampai 20 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);
                }
                if (in_array("21 sampai 30 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);
                }
                if (in_array("31 sampai 40 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                }
                if (in_array("Lebih dari 40 jam", $value['usagetv'])) {
                    $datatreg->Where('usage_tv_last_month','>',40);
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                }
            }
            if(count($value['usagetv']) > 1)
            {                        
                $datatreg->Where(function ($datatreg) use ($value){
                    if (in_array("1 sampai 10 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>=',1)->Where('usage_tv_last_month','<=',10);
<<<<<<< HEAD
                        });                                 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("11 sampai 20 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>=',11)->Where('usage_tv_last_month','<=',20);
<<<<<<< HEAD
                        });                                 
=======
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                    if (in_array("21 sampai 30 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>=',21)->Where('usage_tv_last_month','<=',30);
<<<<<<< HEAD
                        });                                
                    }  
                    if (in_array("31 sampai 40 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                        });                                
                    }                           
                    if (in_array("Lebih dari 40 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>',40);
                        });                                
=======
                        });
                    }
                    if (in_array("31 sampai 40 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>=',31)->Where('usage_tv_last_month','<=',40);
                        });
                    }
                    if (in_array("Lebih dari 40 jam", $value['usagetv'])) {
                        $datatreg->orWhere(function ($datatreg){
                            $datatreg->Where('usage_tv_last_month','>',40);
                        });
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
                    }
                });               
            }
        }

        return (new FastExcel($datatreg->get()))->download('prospect.xlsx', function ($val) {
            return [
                'No Inet' => $val->notel,
                'ND Reference' => $val->nd_reference,
                'Witel' => $val->witel_str,
                'Datel' => $val->datel_str,
                'STO' => $val->abrv_repart,
                'Bulan Bayar Lunas' => $val->nper,
                'Tanggal Bayar' => $val->payment_date,
                'Cara Bayar' => $val->l_bank,
                'Jenis Bayar' => $val->jenis_bayar,
                'Speed Inet' => $val->speed_inet,
                'Speed Pcrf' => $val->speed_pcrf,
                'Tarif Inet' => $val->tarif_inet,
                'Last Upgrade Inet' => $val->startdate_inet,
                'Paket Inet' => $val->paket_inet,
                'CAPS' => $val->caps,
                'WMS' => $val->wms,
                'Homewifi Brite' => $val->homewifi_brite,
                'Movin Seamless' => $val->movin_seamless,
                'Wifi Ext' => $val->wifi_ext,
                'Minipack' => $val->minipack,
                'IH Smart' => $val->ih_smart,
                'PLC' => $val->plc,
                'Nama Pelanggan' => $val->nama_pelanggan_bynoss,
                'No HP' => $val->no_hp,
                'Email MYIH' => $val->email_myih,
                'LCAT' => $val->linecats_item_id,
                'Tanggal PSB' => $val->valid_from,
                'Durasi Telp' => $val->usage_voice,
                'Penggunaan Inet' => $val->usage_inet,
                'Penggunaan TV' => $val->usage_tv,
                'Usia Berlangganan' => $val->usia_ps,
                'Tipe' => $val->indihome,
                'Alamat Gabungan' => $val->alamat_gabungan,
                'Jenis UseeTV' => $val->jenis_useetv,
                'No HP Lainnya' => $val->nohp_pcf,
                'Paket Inet PCRF' => $val->packet_inet_pcrf,
                'Speed PCRF Real' => $val->speed_pcrf_real,
                'Revenue Pots' => $val->revenue_pots,
                'Segmen HVC' => $val->segmen_hvc,
<<<<<<< HEAD
                'Nama ODP' => $val->odp_name,
                'Kwadran Indihome' => $val->kwadran_indihome,
                'Kwadran Internet' => $val->kwadran_internet,
                'Is CT0' => $val->is_ct0,
                'Per CT0' => $val->per_ct0,
=======
                'ODP Name' => $val->odp_name,
                'Root Status' => $val->root_status,
                'Alpro Gpon' => $val->alpro_gpon,
                'Gpon Rx Onu' => $val->gpon_rx_onu,
                'Gpon Name' => $val->gpon_name,
                'Gpon Port' => $val->gpon_port,
                'Gpon SN' => $val->gpon_sn,
                'Alpro RXPoweronu' => $val->alpro_rxpoweronu,
                'Alpro Onu SN' => $val->alpro_onusn,
                'Alpro Portolt' => $val->alpro_portolt,
>>>>>>> 14ee073f6957f456b98a78504aa9f94ea7554500
            ];
        });
    }
}
