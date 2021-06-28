<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\PerformansiKaubis;
use Illuminate\Http\Request;
use Gate;
use App\Models\MasterData;
use App\Models\Witel;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterDataController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('master_treg_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.masterData.index');
    }

    public function show(Request $request)
    {
        abort_if(Gate::denies('master_treg_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $data = MasterData::where('notel', '=', $request->notel);

        $customer = $data->firstOrFail();

        $cust_reference = $customer->nd_reference;
        $amount_notel = $data->select('bill_amount','payment_amount')->first();
        
        $amount_reference = MasterData::select('bill_amount','payment_amount')->where('notel', '=', $cust_reference)->first();  

        if ($amount_reference != null) {
            $amount_reference_bill = $amount_reference->bill_amount;
            $amount_reference_payment = $amount_reference->payment_amount;
        } else {
            $amount_reference_bill = 0;
            $amount_reference_payment = 0;
        }
        
        $total_bill = $amount_notel->bill_amount + $amount_reference_bill;
        $total_payment = $amount_notel->payment_amount + $amount_reference_payment;

        if ($total_bill == $total_payment) {
            $status = "Lunas";
        } else {
            $total_kurang = $total_bill - $total_payment;
            $status = "Kurang Bayar Rp. " + $total_kurang;
        }

        $arr_nohp_pcf = array();
        foreach (explode(';', $customer->nohp_pcf) as $item) {
            if ($item != '') {
                array_push($arr_nohp_pcf, $item);
            }
        }
    
        $arr_minipack = array(); 
        foreach (explode(',', $customer->minipack) as $item) {
            array_push($arr_minipack, $item);
        }

        $arr_movinSeamless = array(); 
        foreach (explode(',', $customer->movin_seamless) as $item) {
            array_push($arr_movinSeamless, $item);
        }

        $arr_plc = array(); 
        foreach (explode(',', $customer->plc) as $item) {
            array_push($arr_plc, $item);
        }

        $arr_wifiExt = array(); 
        foreach (explode(',', $customer->wifi_ext) as $item) {
            array_push($arr_wifiExt, $item);
        }

        $no_tlp = $customer->hp_pelapor_ticket;
        $arr_tlp = array();
        foreach (explode(',', $no_tlp) as $item) {
            array_push($arr_tlp, $item);
        }        

        $arr_newProductDesc = array();
        foreach (explode(',', $customer->neworder_product_desc) as $item) {
            array_push($arr_newProductDesc, $item);
        }

        $arr_newTypeIndihome = array();
        foreach (explode(',', $customer->neworder_typeindihome) as $item) {
            array_push($arr_newTypeIndihome, $item);
        }

        $arr_newTypeAddon = array();
        foreach (explode(',', $customer->neworder_typeaddon) as $item) {
            array_push($arr_newTypeAddon, $item);
        }

        return view('admin.masterData.show', compact('customer', 'arr_movinSeamless', 'arr_plc', 'arr_wifiExt', 
            'arr_minipack', 'arr_tlp', 'no_tlp', 'arr_newProductDesc', 'arr_newTypeIndihome', 'arr_newTypeAddon',
            'total_bill','total_payment','status','arr_nohp_pcf'));
    }
    
    public function assets(Request $request)
    {
        abort_if(Gate::denies('master_treg_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $request->notel = '161201201966';   
        if ($request->ajax()) {

            if ($request->notel != '') {
                
                $cust = DB::connection('pg3')->table('DOSSIER_REV_NAS_202103')
                ->select(
                    'ncli', 'nd_reference', 'revenue_trems'
                )
                ->where('notel', $request->notel)->first();

                $assets_internet = DB::connection('pg3')->table('FACT_ASSET_NCX')
                ->select(
                    'product_code', 'asset_name', 'child_asset_amount_x', 'root_status',                 
                    DB::raw("(TO_CHAR(x_active_dt, 'YYYY-MM-DD')) as active_date"),
                )
                ->where('nd', $request->notel)->get();

                $nd_reference = $cust->nd_reference;
                $cust_reference = DB::connection('pg3')->table('DOSSIER_REV_NAS_202103')
                ->select(
                    'ncli', 'nd_reference', 'revenue_trems'
                )
                ->where('notel', $nd_reference)->first();

                $assets_telp = DB::connection('pg3')->table('FACT_ASSET_NCX')
                ->select(
                    'product_code', 'asset_name', 'child_asset_amount_x', 'root_status',                 
                    DB::raw("(TO_CHAR(x_active_dt, 'YYYY-MM-DD')) as active_date"),
                )
                ->where('nd', $cust->nd_reference)->get();

                $trems_payment = DB::connection('pg3')->table('TREMS_PAYMENT_2021')
                ->select(
                    'nper', 'telp', 'payment_date', 'l_bank', 'jenis', 'billing_amount', 'payment_amount',                
                )
                ->where('telp', $request->notel)->orWhere('telp', $nd_reference)
                ->orderBy('nper', 'desc')->limit(6)->get();

                $data = [
                    'cust' => $cust,
                    'assets_internet' => $assets_internet,
                    'cust_reference' => $cust_reference,
                    'assets_telp' => $assets_telp,
                    'trems_payment' => $trems_payment,
                ];
            } else {
                $data = [
                    'cust' => NULL,
                    'assets_internet' => NULL,
                    'cust_reference' => NULL,
                    'assets_telp' => NULL,
                    'trems_payment' => NULL,
                ];
            }

            return response()->json($data);
        }

        return view ('admin.masterData.assets');
    }

    public function histProvisioning(Request $request)
    {
        abort_if(Gate::denies('master_treg_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->nomor != '') {
                $dt_provisioning = DB::connection('pg15')->table('SC_PROVISIONING_DETAIL')
                    ->where('order_id', $request->nomor)->orWhere('internet', $request->nomor)
                    ->orderBy('create_dtm', 'desc')
                    ->get();

                $data = [
                    'dt_count' => count($dt_provisioning),
                    'dt_provisioning' => $dt_provisioning
                ];
            } else {
                $data = [
                    'dt_provisioning' => NULL
                ];
            }      
            
            return response()->json($data);
        }

        return view('admin.masterData.histProvisioning');
    }
}
