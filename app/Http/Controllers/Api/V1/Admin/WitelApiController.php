<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWitelRequest;
use App\Http\Requests\UpdateWitelRequest;
use App\Http\Resources\Admin\WitelResource;
use App\Models\Witel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WitelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('witel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WitelResource(Witel::with(['regional'])->get());
    }

    public function store(StoreWitelRequest $request)
    {
        $witel = Witel::create($request->all());

        return (new WitelResource($witel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Witel $witel)
    {
        abort_if(Gate::denies('witel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WitelResource($witel->load(['regional']));
    }

    public function update(UpdateWitelRequest $request, Witel $witel)
    {
        $witel->update($request->all());

        return (new WitelResource($witel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Witel $witel)
    {
        abort_if(Gate::denies('witel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
