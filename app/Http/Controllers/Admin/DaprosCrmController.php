<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EdukasiPelangganExport;
use App\Http\Controllers\Controller;
use App\Models\CaringCt0;
use App\Models\EdukasiPelanggan;
use App\Models\NewCustomerKnowledge;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel as Excel;

class DaprosCrmController extends Controller
{
    //
    public function index()
    {
        $data = CaringCt0::take(5)->get();
        return view('admin.daprosCrm.index');
    }

    public function edukasi(Request $request)
    {
        $nper = NewCustomerKnowledge::select('nper')->groupBy('nper')->orderBy('nper','DESC')->pluck('nper');
        if ($request->ajax()) {
            $query = NewCustomerKnowledge::query()->select(sprintf('%s.*', (new NewCustomerKnowledge())->table))->where('status',0);
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addIndexColumn();
            
            $table->editColumn('witel_str', function ($row) {
                return $row->witel_str ? $row->witel_str : "";
            });
            $table->editColumn('nama_pelanggan', function ($row) {
                return $row->nama_pelanggan ? $row->nama_pelanggan : "";
            });
            $table->editColumn('alamat', function ($row) {
                return $row->alamat ? $row->alamat : "";
            });
            $table->editColumn('notel', function ($row) {
                return $row->notel ? $row->notel : "";
            });
            $table->editColumn('paket_inet', function ($row) {
                return $row->paket_inet ? $row->paket_inet : "";
            });
            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('status_svm', function ($row) {
                return $row->status_svm ? $row->status_svm : "";
            });
            $table->editColumn('valid_from', function ($row) {
                return $row->valid_from ? $row->valid_from : "";
            });
            $table->editColumn('nper', function ($row) {
                return $row->nper ? $row->nper : "";
            });
            $table->editColumn('payment_date', function ($row) {
                return $row->payment_date ? $row->payment_date : "";
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }
        return view('admin.daprosCrm.edukasi',compact('nper'));
    }

    public function downloadEdukasi(Request $request)
    {
        return Excel::download(new EdukasiPelangganExport($request->all()),'DaprosEdukasiPelanggan.xlsx');
    }
}
