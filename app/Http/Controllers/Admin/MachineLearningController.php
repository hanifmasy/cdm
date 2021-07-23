<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MlCt0;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MachineLearningController extends Controller
{
    //
    public function ct0()
    {
        $queryBilling = MlCt0::select(array(
            'pergerakan_billing',
            DB::raw('count(1)')
        ))->groupBy('pergerakan_billing')->get();

        $queryOnOff = MlCt0::select(array(
            'status_modem_text',
            DB::raw('count(1)')
        ))->where('pergerakan_billing', 'TETAP')->groupBy('status_modem_text')->get();

        $queryDetectUsage = MlCt0::select(array(
            'detect_usage',
            DB::raw('count(1)')
        ))->where('pergerakan_billing', 'TETAP')->where('status_modem_text', 'ONLINE')->groupBy('detect_usage')->get();

        $querySpekUnspek = MlCt0::select(array(
            'spec_text',
            DB::raw('count(1)')
        ))->where('pergerakan_billing', 'TETAP')->where('status_modem_text', 'ONLINE')->where('detect_usage', 'NORMAL_USE')->groupBy('spec_text')->get();

        $queryOverFup = MlCt0::select(array(
            'status_fup',
            DB::raw('count(1)')
        ))->where('pergerakan_billing', 'TETAP')->where('status_modem_text', 'ONLINE')->where('detect_usage', 'NORMAL_USE')->groupBy('status_fup')->get();

        $total_belum_bayar = 0;
        $total_sudah_bayar = 0;
        $total_offline = 0;
        $total_online = 0;
        $total_detect_usage = 0;
        $total_no_use8_days = 0;
        $total_normal_use = 0;
        $total_null_use = 0;
        $total_spek = 0;
        $total_unspek = 0;
        $total_over_fup = 0;
        $total_normal_fup = 0;

        foreach ($queryBilling as $row) {
            if ($row->pergerakan_billing == "TETAP") {
                $total_belum_bayar += $row->count;
            }
            if ($row->pergerakan_billing == "BERGERAK") {
                $total_sudah_bayar += $row->count;
            }
        }

        foreach ($queryOnOff as $row) {
            if ($row->status_modem_text == "OFFLINE") {
                $total_offline += $row->count;
            }
            if ($row->status_modem_text == "ONLINE") {
                $total_online += $row->count;
            }
        }

        foreach ($queryDetectUsage as $row) {
            if ($row->detect_usage == "NO_USE_8DAYS") {
                $total_no_use8_days += $row->count;
            }
            if ($row->detect_usage == "NORMAL_USE") {
                $total_normal_use += $row->count;
            }
            if ($row->detect_usage == "NULL") {
                $total_null_use += $row->count;
            }
        }

        foreach ($querySpekUnspek as $row) {
            if ($row->spec_text == "SPEK") {
                $total_spek += $row->count;
            }
            if ($row->spec_text == "UNSPEK") {
                $total_unspek += $row->count;
            }
        }

        foreach ($queryOverFup as $row) {
            if ($row->status_fup == "OVER_FUP") {
                $total_over_fup += $row->count;
            }
            if ($row->status_fup == "NORMAL") {
                $total_normal_fup += $row->count;
            }
        }

        return view('admin.machineLearning.ct0.index', compact('total_belum_bayar','total_sudah_bayar', 'total_offline', 'total_online', 'total_no_use8_days', 'total_normal_use', 'total_null_use', 'total_spek', 'total_unspek', 'total_over_fup', 'total_normal_fup'));
    }

    public function ct0Details(Request $request){
        if($request->ajax()){
            $queryBilling = MlCt0::select('*');
            
            if($request->pergerakan_bill)
            {
                if($request->pergerakan_bill == 'TETAP')
                {
                    $queryBilling->where('pergerakan_billing','TETAP');
                }
                else{
                    $queryBilling->where('pergerakan_billing','BERGERAK');
                }
            }
            if($request->onoff)
            {
                if($request->onoff == 'OFFLINE'){
                    $queryBilling->where('status_modem_text','OFFLINE');
                }else{
                    $queryBilling->where('status_modem_text','ONLINE');
                }
            }
            if($request->detectusage)
            {
                if($request->detectusage == 'NORMAL_USE'){
                    $queryBilling->where('detect_usage','NORMAL_USE');
                }
                elseif($request->detectusage == 'NO_USE_8DAYS'){
                    $queryBilling->where('detect_usage','NO_USE_8DAYS');
                }
                else{
                    $queryBilling->where('detect_usage','NULL');
                }
            }
            if($request->spekunspek)
            {
                if($request->spekunspek == 'SPEK'){
                    $queryBilling->where('spec_text','SPEK');
                }
                else{
                    $queryBilling->where('spec_text','UNSPEK');
                }
            }
            if($request->statusfup)
            {
                if($request->statusfup == 'NORMAL'){
                    $queryBilling->where('status_fup','NORMAL');
                }
                else{
                    $queryBilling->where('status_fup','OVER_FUP');
                }
            }
            $table = DataTables::of($queryBilling->get());

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();

            $table->editColumn('notel', function($row){
                return $row->notel ?? '';
            });
            $table->editColumn('nper', function($row){
                return $row->nper ?? '';
            });
            $table->editColumn('spec_text', function($row){
                return $row->spec_text ?? '';
            });
            $table->editColumn('status_modem_text', function($row){
                return $row->status_modem_text ?? '';
            });
            $table->editColumn('detect_usage', function($row){
                return $row->detect_usage ?? '';
            });
            $table->editColumn('status_fup', function($row){
                return $row->status_fup ?? '';
            });
            $table->editColumn('status_gangguan_text', function($row){
                return $row->status_gangguan_text ?? '';
            });
            $table->editColumn('usia_ps', function($row){
                return $row->usia_ps ?? '';
            });
            $table->editColumn('last_payment_month', function($row){
                return $row->last_payment_month ?? '';
            });
            $table->editColumn('paket_inet', function($row){
                return $row->paket_inet ?? '';
            });
            $table->rawColumns(['placeholder']);

            return $table->make(true);  
        }
        return view('admin.machineLearning.ct0.show');
    }
}
