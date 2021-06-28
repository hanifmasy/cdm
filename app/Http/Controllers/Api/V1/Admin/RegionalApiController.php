<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionalRequest;
use App\Http\Requests\UpdateRegionalRequest;
use App\Http\Resources\Admin\RegionalResource;
use App\Models\Regional;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegionalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('regional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RegionalResource(Regional::all());
    }

    public function store(StoreRegionalRequest $request)
    {
        $regional = Regional::create($request->all());

        return (new RegionalResource($regional))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Regional $regional)
    {
        abort_if(Gate::denies('regional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RegionalResource($regional);
    }

    public function update(UpdateRegionalRequest $request, Regional $regional)
    {
        $regional->update($request->all());

        return (new RegionalResource($regional))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Regional $regional)
    {
        abort_if(Gate::denies('regional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regional->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
