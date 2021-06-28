<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWitelRequest;
use App\Http\Requests\StoreWitelRequest;
use App\Http\Requests\UpdateWitelRequest;
use App\Models\Regional;
use App\Models\Witel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WitelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('witel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Witel::with(['regional'])->select(sprintf('%s.*', (new Witel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'witel_show';
                $editGate      = 'witel_edit';
                $deleteGate    = 'witel_delete';
                $crudRoutePart = 'witels';

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
            $table->editColumn('nama_witel', function ($row) {
                return $row->nama_witel ? $row->nama_witel : "";
            });
            $table->addColumn('regional_nama_regional', function ($row) {
                return $row->regional ? $row->regional->nama_regional : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'regional']);

            return $table->make(true);
        }

        $regionals = Regional::get();

        return view('admin.witels.index', compact('regionals'));
    }

    public function create()
    {
        abort_if(Gate::denies('witel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regionals = Regional::all()->pluck('nama_regional', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.witels.create', compact('regionals'));
    }

    public function store(StoreWitelRequest $request)
    {
        $witel = Witel::create($request->all());

        return redirect()->route('admin.witels.index');
    }

    public function edit(Witel $witel)
    {
        abort_if(Gate::denies('witel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regionals = Regional::all()->pluck('nama_regional', 'id')->prepend(trans('global.pleaseSelect'), '');

        $witel->load('regional');

        return view('admin.witels.edit', compact('regionals', 'witel'));
    }

    public function update(UpdateWitelRequest $request, Witel $witel)
    {
        $witel->update($request->all());

        return redirect()->route('admin.witels.index');
    }

    public function show(Witel $witel)
    {
        abort_if(Gate::denies('witel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witel->load('regional');

        return view('admin.witels.show', compact('witel'));
    }

    public function destroy(Witel $witel)
    {
        abort_if(Gate::denies('witel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $witel->delete();

        return back();
    }

    public function massDestroy(MassDestroyWitelRequest $request)
    {
        Witel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
