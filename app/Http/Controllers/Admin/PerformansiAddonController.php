<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use Illuminate\Http\Request;
use Gate;
use App\Models\PerformansiAddon;
use App\Models\Witel;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerformansiAddonController extends Controller
{
    public function index(Request $request)
    {
        $date_now = Carbon::now();
        $year_now = $date_now->year;
        
        abort_if(Gate::denies('performansi_addon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $query = PerformansiAddon::where('psb', 1)->groupBy('addon')->orderBy('report_month', 'desc')->get();
        // dd($query);

        if ($request->ajax()) {

            $query = PerformansiAddon::where('psb', 1);
            if($request->filter_year != '') {
                $query->where(DB::raw('substr(report_month, 1, 4)'), '=', $request->filter_year);
            }
            else{
                $query->where(DB::raw('substr(report_month, 1, 4)'), '=', $year_now);
            }
            if($request->filter_month != '') {                
                $query->where(DB::raw('substr(report_month, 5, 6)'), '=', $request->filter_month);
            }
            if($request->filter_witel != '') {
                $query->where('witel', '=', $request->filter_witel);
            }
            if($request->filter_datel != '') {
                $query->where('datel', '=', $request->filter_datel);
            }
            
            $table = Datatables::of($query->orderBy('report_month', 'desc'));

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('report_month', function ($row) {
                return $row->report_month ? $row->report_month : "";
            });
            $table->editColumn('addon', function ($row) {
                return $row->addon ? $row->addon : "";
            });
            $table->editColumn('ndem', function ($row) {
                return $row->ndem ? $row->ndem : "";
            });
            $table->editColumn('kcontact', function ($row) {
                return $row->kcontact ? $row->kcontact : "";
            });
            $table->editColumn('coper', function ($row) {
                return $row->coper ? $row->coper : "";
            });
            $table->editColumn('cagent', function ($row) {
                return $row->cagent ? $row->cagent : "";
            });
            $table->editColumn('kawasan', function ($row) {
                return $row->kawasan ? $row->kawasan : "";
            });
            $table->editColumn('witel', function ($row) {
                return $row->witel ? $row->witel : "";
            });
            $table->editColumn('datel', function ($row) {
                return $row->datel ? $row->datel : "";
            });
            $table->editColumn('sto', function ($row) {
                return $row->sto ? $row->sto : "";
            });
            $table->editColumn('channel', function ($row) {
                return $row->channel ? $row->channel : "";
            });
            $table->editColumn('alpro', function ($row) {
                return $row->alpro ? $row->alpro : "";
            });
            $table->editColumn('tgl_va', function ($row) {
                return $row->tgl_va ? $row->tgl_va : "";
            });
            $table->editColumn('tgl_ps', function ($row) {
                return $row->tgl_ps ? $row->tgl_ps : "";
            });
            $table->editColumn('cgest', function ($row) {
                return $row->cgest ? $row->cgest : "";
            });
            $table->editColumn('cseg', function ($row) {
                return $row->cseg ? $row->cseg : "";
            });
            $table->editColumn('ccat', function ($row) {
                return $row->ccat ? $row->ccat : "";
            });
            $table->editColumn('linecats_family_lname', function ($row) {
                return $row->linecats_family_lname ? $row->linecats_family_lname : "";
            });
            $table->editColumn('tematik', function ($row) {
                return $row->tematik ? $row->tematik : "";
            });
            $table->editColumn('item', function ($row) {
                return $row->item ? $row->item : "";
            });
            $table->editColumn('cpack', function ($row) {
                return $row->cpack ? $row->cpack : "";
            });
            $table->editColumn('psb', function ($row) {
                return $row->psb ? $row->psb : "";
            });
            $table->editColumn('cbt', function ($row) {
                return $row->cbt ? $row->cbt : "";
            });
            $table->editColumn('mig', function ($row) {
                return $row->mig ? $row->mig : "";
            });
            $table->editColumn('price_psb', function ($row) {
                return $row->price_psb ? $row->price_psb : "";
            });
            $table->editColumn('price_cbt', function ($row) {
                return $row->price_cbt ? $row->price_cbt : "";
            });
            $table->editColumn('price_mig', function ($row) {
                return $row->price_mig ? $row->price_mig : "";
            });
            $table->editColumn('ndinet', function ($row) {
                return $row->ndinet ? $row->ndinet : "";
            });
            $table->editColumn('kaubis', function ($row) {
                return $row->kaubis ? $row->kaubis : "";
            });
            $table->editColumn('nik', function ($row) {
                return $row->nik ? $row->nik : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);

        }
        $witels = Witel::pluck('nama_witel', 'id');
        $datels = PerformansiAddon::select('datel')->groupBy('datel')->pluck('datel');

        // dd($datels);

        return view('admin.performansiAddon.index', compact('witels', 'datels'));
    }
}
