<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\NotelsResources;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class NotelsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // abort_if(Gate::denies('api_notel'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make(['notel' => $request->notel], [
            'notel' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->getMessageBag()->getMessages()], 422);
        }
        $data = MasterData::select('witel_str', 'nama_pelanggan_billingpcf', 'alamat_gabungan', 'tarif_inet', 'speed_inet','speed_pcrf','revenue_trems')->where('notel', $request->notel)->first();
        if ($data == null) {
            return response()->json(['success' => false, 'data' => null], 422);
        }
        return new NotelsResources($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
