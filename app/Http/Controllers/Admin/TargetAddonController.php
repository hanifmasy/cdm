<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use Illuminate\Http\Request;
use Gate;
use App\Models\TargetAddon;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class TargetAddonController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('target_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $data = TargetAddon::all();
        // dd($data);
        // $query = TargetAddon::query()->select(sprintf('%s.*', (new TargetAddon)->table));
        // $table = Datatables::of($query);

        // dd($query);

        if ($request->ajax()) {
            $query = TargetAddon::get();
            $table = Datatables::of($query);

            // dd($query);

            // $data = TargetAddon::all();
            // dd($data);

            $table->addColumn('placeholder', '&nbsp;');
            // $table->addColumn('actions', '&nbsp;');

            // $table->editColumn('actions', function ($row) {
            //     $viewGate      = 'regional_show';
            //     $editGate      = 'regional_edit';
            //     $deleteGate    = 'regional_delete';
            //     $crudRoutePart = 'targetAddon';

            //     return view('partials.datatablesActions', compact(
            //         'viewGate',
            //         'editGate',
            //         'deleteGate',
            //         'crudRoutePart',
            //         'row'
            //     ));
            // });

            $table->editColumn('report_month', function ($row) {
                return $row->report_month ? $row->report_month : "";
            });
            $table->editColumn('addon', function ($row) {
                return $row->addon ? $row->addon : "";
            });
            $table->editColumn('witel', function ($row) {
                return $row->witel ? $row->witel : "";
            });
            $table->editColumn('datel', function ($row) {
                return $row->datel ? $row->datel : "";
            });
            $table->editColumn('ssl', function ($row) {
                return $row->ssl ? $row->ssl : "";
            });
            $table->editColumn('revenue', function ($row) {
                return $row->revenue ? $row->revenue : "";
            });
            $table->editColumn('real_ssl', function ($row) {
                return $row->real_ssl ? $row->real_ssl : "";
            });
            $table->editColumn('real_revenue', function ($row) {
                return $row->real_revenue ? $row->real_revenue : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }

        return view('admin.targetAddon.index');
    }
}
