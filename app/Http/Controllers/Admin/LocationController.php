<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerLocations;
use App\Models\Witel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $request)
    {   
        
        if ($request->ajax()) {
            $latitude = -1.256451;
            $longitude = 116.867629;

            if($request->latlong != "")
            {
                $exp = explode(',',$request->latlong);
                $latitude = trim($exp[0],"\t\n\r\0\x0B");
                $longitude = trim($exp[1],"\t\n\r\0\x0B");
            }
            $query = DB::connection('pg16')->table('MASTERDATAMAP')
            ->select("MYTABLE.*")
            ->join(DB::raw('(SELECT *,acos(sin('.$latitude.' * pi() / 180) * sin(latitude_map * pi() / 180) + cos('.$latitude.' * pi() / 180) * cos(latitude_map * pi() / 180) * cos(('.$longitude.' - longitude_map) * pi() / 180)) * 180 / pi() * 60 * 1.1515 * 1.609344 AS distance FROM "MASTERDATAMAP") "MYTABLE"'), 
            function($join)
            {
                $join->on("MASTERDATAMAP.id", '=', "MYTABLE.id");
            });
            if (empty($request->all()))
            {
                $query->where('MYTABLE.distance','<=', 1)->take(10);
            }

            if ($request->witel != "") {                
                $query->whereIn('MYTABLE.witel_str',$request->witel);
            }    
            
            if ($request->typeMap != "") {                
                $query->whereIn('MYTABLE.sumber_map', $request->typeMap);                    
            }

            if ($request->segmen != "") {                
                $query->whereIn('MYTABLE.segmen_hvc', $request->segmen);                    
            }

            if ($request->unspec != "") {                
                $query->whereIn('MYTABLE.spek_underspek', $request->unspec);                    
            }

            if ($request->nps != "") {                
                $query->whereIn('MYTABLE.nps', $request->nps);                    
            }

            if ($request->gangguan != "") {                
                $query->whereIn('MYTABLE.map_gangguan', $request->gangguan);                    
            }

            if ($request->channel_bayar != "") {                
                $query->whereIn('MYTABLE.map_channel_bayar', $request->channel_bayar);                    
            }

            if ($request->minipack != "") {                
                $query->whereIn('MYTABLE.map_minipack', $request->minipack);                    
            }

            if ($request->stb != "") {                
                $query->whereIn('MYTABLE.map_stb_tambahan', $request->stb);                    
            }
            
            // STEP 3
            if ($request->segmen_v2 != "") {                
                $query->whereIn('MYTABLE.segmen_hvc', $request->segmen_v2);                    
            }

            if ($request->unspec_v2 != "") {                
                $query->whereIn('MYTABLE.spek_underspek', $request->unspec_v2);                    
            }

            if ($request->nps_v2 != "") {                
                $query->whereIn('MYTABLE.nps', $request->nps_v2);                    
            }

            if ($request->gangguan_v2 != "") {                
                $query->whereIn('MYTABLE.map_gangguan', $request->gangguan_v2);                    
            }

            if ($request->channel_bayar_v2 != "") {                
                $query->whereIn('MYTABLE.map_channel_bayar', $request->channel_bayar_v2);                    
            }

            if ($request->minipack_v2 != "") {                
                $query->whereIn('MYTABLE.map_minipack', $request->minipack_v2);                    
            }

            if ($request->stb_v2 != "") {                
                $query->whereIn('MYTABLE.map_stb_tambahan', $request->stb_v2);                    
            }

            $data = [
                'locations' => $query->cursor()
            ];

            return response()->json($data); 

        }

        $witels = Witel::get(['id', 'nama_witel']);
        $segmens = array('HVC_PLATINUM', 'HVC_GOLD', 'HVC_SILVER', 'HVC_REGULER');   
        $type_maps = array('APPROX', 'REAL');   
        $unspecs = array('SPEC', 'UNDERSPEC', 'NOT ONLINE');   
        $npss = array('DETRACTOR', 'PASSIVE', 'PROMOTOR', 'BELUM_SURVEY');   
        $gangguans = array('OPEN', 'CLOSED', 'NO_TICKET'); 
        $channel_bayars = array('BANK', 'CTB', 'DIGITAL', 'EGBIS', 'NO_PAY', 'PLASA', 'SOPP'); 
        $minipacks = array('DAPROS', 'EXIST', 'NONE'); 
        $stbs = array('DAPROS', 'EXIST', 'NONE'); 
        
        return view('admin.customerLocation.index',compact('witels','segmens', 'type_maps', 
            'unspecs', 'npss', 'gangguans', 'channel_bayars', 'minipacks', 'stbs'));
    }

    public function dapros(Request $request)
    {
        $query = DB::connection('pg16')->table('MASTERDATAMAP')->where('segmen_hvc', '!=', 'HVC_REGULER');
        if ($request->ajax()) {
            if ($request->witel != "") {
                $query->whereIn('witel_str', $request->witel);
            }

            if ($request->dapros == "gangguan") {
                $query->where('map_gangguan', "OPEN");
            } else if ($request->dapros == "underspec") {
                $query->where('spek_underspek', "UNDERSPEC");
            } else if ($request->dapros == "ct0") {
                $query->where('map_prev_churn', "PREV_CHURN");
            } else if ($request->dapros == "qcnvalid") {
                $query->where('map_qc_valid', "BELUM");
            } else if ($request->dapros == "minipack") {
                $query->where('map_minipack', "DAPROS");
            } else if ($request->dapros == "stb") {
                $query->where('map_stb_tambahan', "DAPROS");
            } else if ($request->dapros == "upgrade") {
                $query->where('map_upgrade', "DAPROS");
            } else if ($request->dapros == "mig2p3p") {
                $query->where('map_mig2p3p', "DAPROS");
            }

            $data = [
                'locations' => $query->cursor()
            ];

            return response()->json($data); 
        }
        
        $witels = Witel::get(['id', 'nama_witel']);
        return view('admin.customerLocation.dapros', compact('witels'));
    }
}
