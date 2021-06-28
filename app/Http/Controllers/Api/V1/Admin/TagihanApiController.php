<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TagihanResource;
use App\Models\MasterData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TagihanApiController extends Controller
{
    //
    public function index(Request $request)
    {
        // dd("Not Secure");
        // abort_if(Gate::denies('api_tagihan'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make(['notel' => $request->notel ], [
            'notel' => 'required|numeric'
            ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->getMessageBag()->getMessages()], 422);
        }
        $source = MasterData::select('nper','notel','revenue_trems','nama_pelanggan_billingpcf','l_bank','payment_date','payment_amount','rev_trems_ncli')->where('notel',$request->notel)->first();
        $dateNow = Carbon::now()->format('Ym');
        $status = null;
        if($source == null)
        {
            return response()->json(['success' => "NOT OK",'nama'=>null, 'ipayment' => [
                [
                    'periode' => null,
                    'jumlah_tagihan' => null,
                    'belum_bayar' => null, 
                    'status_pembayaran' => $status,
                    'lokasi_pembayaran' => null,
                    'cicilan' => null,
                    'tanggal' => null,
                    // 'payment_amount' => $source->payment_amount,
                    'billing_bulan_ini' => null,
                    'cicilan_data' => null
                ]
                ]
            ], 422);
        }
        if($source->nper == $dateNow)
        {
            $status = "LUNAS";
        }else{
            $status = "BELUM LUNAS";
        }
        $data = [
            'periode' => $source->nper,
            'jml_tagihan' => $source->revenue_trems,
            'belum_bayar' => $source->revenue_trems ? ($source->revenue_trems - $source->payment_amount) : 0, 
            'status_pembayaran' => $status,
            'lokasi_pembayaran' => $source->l_bank,
            'cicilan' => null,
            'tanggal' => $source->payment_date,
            // 'payment_amount' => $source->payment_amount,
            // 'billing_bulan_ini' => $source->rev_trems_ncli,
            'cicilan_data' => null
        ];
        return response()->json(['status' => "OK",'nama'=> $source->nama_pelanggan_billingpcf,'ipayment' => [$data]], 200);
    }
}
