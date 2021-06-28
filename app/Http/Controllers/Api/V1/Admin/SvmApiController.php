<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SvmResources;
use App\Models\StatusSvm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SvmApiController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->inet)
        {
            $validator = Validator::make(['inet' => $request->inet ], [
                'inet' => 'required|numeric'
                ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'data' => []], 404);
            }
            // try{
            //     $res = @file_get_contents('http://10.128.21.37/qc-borneo-validation/api/v1/cek-status-qc?nomor_sc='.$query[0]['sc']);
            //     $itemsJson = json_decode($res,true);
            //     foreach ($itemsJson['data'] as $item) {
            //         $data[0] = [
            //             'sc' => $query[0]['sc'],
            //             'status_qc' => $item['status_qc'],
            //             'ccat' => $query[0]['ccat'],
            //             'nd_speedy' => $query[0]['nd_speedy'],
            //             'nd' => $query[0]['nd'],
            //             'status_svm' => $query[0]['status_svm'],
            //             'hp' => $query[0]['hp'],
            //             'email' => $query[0]['email'],
            //             'date_ps' => $query[0]['date_ps'],
            //         ];
            //     }
            // }catch(Throwable $e){
            //     return response()->json(['success' => false, 'data' => []], 404);
            // }
        }
        else if($request->sc)
        {
            $validator = Validator::make(['sc' => $request->sc ], [
                'sc' => 'required|numeric'
                ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'data' => []], 404);
            }
        }
        try{
            $key = $request->sc ?? $request->inet;
            $data = Cache::remember($key, now()->addMinutes(5), function() use ($request){
                $value = [];
                if($request->inet)
                {
                    $value = StatusSvm::where('nd_speedy',$request->inet)->select(['sc','status_qc','ccat','nd_speedy','nd','status_svm','hp','email','date_ps'])->orderBy('date_ps','DESC')->distinct()->get();
                }else if($request->sc){
                    $value = StatusSvm::where('sc',$request->sc)->select(['sc','status_qc','ccat','nd_speedy','nd','status_svm','hp','email','date_ps'])->orderBy('date_ps','DESC')->distinct()->get();
                }
                return $value;
            });
            return new SvmResources($data);
        }catch(Throwable $e){
            return new SvmResources(['data'=> []]);
        }
    }
}
