<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DetailProvisioningResource;
use App\Models\ReportPda;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DetailProvisioningApiController extends Controller
{
    //
    public function index(Request $request)
    {
        abort_if(Gate::denies('api_notel'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make(['sc' => $request->sc], [
            'sc' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'data' => null], 422);
        }
        $data = ReportPda::select('order_id', 'create_dtm', 'order_type_id', 'witel', 'internet', 'status_order', 'update_dtm')->where('order_id', $request->sc)->first();
        if ($data == null) {
            return response()->json(['success' => false, 'data' => [null]], 422);
        }
        return new DetailProvisioningResource($data);
    }
}
