<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CekHvcResource;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CekHvcApiController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        $validator = Validator::make(['notel' => $request->notel ], [
            'notel' => 'required|numeric'
            ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'data' => []], 422);
        }
        $data = MasterData::select('nper','segmen_hvc','root_status')->where('notel',$request->notel)->get();
        if($data == null)
        {
            return response()->json(['success' => false, 'data' => []], 422);
        }
        return new CekHvcResource($data);
    }
}
