<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRegionalRequest;
use App\Http\Requests\StoreRegionalRequest;
use App\Http\Requests\UpdateRegionalRequest;
use App\Models\Regional;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use App\Models\TargetAddon;

class RegionalController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('regional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Regional::query()->select(sprintf('%s.*', (new Regional)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'regional_show';
                $editGate      = 'regional_edit';
                $deleteGate    = 'regional_delete';
                $crudRoutePart = 'regionals';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('nama_regional', function ($row) {
                return $row->nama_regional ? $row->nama_regional : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.regionals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('regional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.regionals.create');
    }

    public function store(StoreRegionalRequest $request)
    {
        $regional = Regional::create($request->all());

        return redirect()->route('admin.regionals.index');
    }

    public function edit(Regional $regional)
    {
        abort_if(Gate::denies('regional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.regionals.edit', compact('regional'));
    }

    public function update(UpdateRegionalRequest $request, Regional $regional)
    {
        $regional->update($request->all());

        return redirect()->route('admin.regionals.index');
    }

    public function show(Regional $regional)
    {
        abort_if(Gate::denies('regional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.regionals.show', compact('regional'));
    }

    public function destroy(Regional $regional)
    {
        abort_if(Gate::denies('regional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regional->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegionalRequest $request)
    {
        Regional::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
