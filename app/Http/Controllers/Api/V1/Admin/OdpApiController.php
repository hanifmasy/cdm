<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OdpResource;
use App\Models\OdpMaster;
use Illuminate\Http\Request;

class OdpApiController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = null;
        if($request->nama_odp)
        {
            $data = OdpMaster::where('odp_name',$request->nama_odp)->get();
        }
        return new OdpResource($data);
    }
}
