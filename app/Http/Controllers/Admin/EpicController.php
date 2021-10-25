<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\PraNPCExport;
use App\Exports\PraPraNPCExport;
use App\Models\NewCt0;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel as Excel;

class EpicController extends Controller
{
  public function pra_npc(Request $request){
    if($request->ajax()){
      $source = '';
      $prediction = '';
      $segmen = '';
      $segmen_hvc = '';
      $tunggakan = '';
      if($request->source){ $source = $request->source; }
      if($request->prediction){ $prediction = $request->prediction; }
      if($request->segmen){ $segmen = $request->segmen; }
      if($request->segmen_hvc){ $segmen_hvc = $request->segmen_hvc; }
      if($request->tunggakan){ $tunggakan = $request->tunggakan; }

      $total_table_1 = DB::connection('pg19')->table('prediction_ct0_monitor')->select(array(
          'witel_area',
          DB::raw("SUM(CASE WHEN prioritas = '1' THEN 1 ELSE 0 END) AS datapra1"),
          DB::raw("SUM(CASE WHEN moving_bill = 'BERGERAK' THEN 1 ELSE 0 END) AS paid"),
          DB::raw("SUM(CASE WHEN moving_bill = 'TETAP' THEN 1 ELSE 0 END) AS nonpaid"),
          DB::raw("SUM(CASE WHEN cat_spec = 'OFFLINE' THEN 1 ELSE 0 END) AS offline"),
          DB::raw("SUM(1) AS total")
      ))->where('prioritas', '1');
      if($source != ''){ $total_table_1->where('sumber',$source); }
      if($prediction != ''){ $total_table_1->where('prediction',$prediction); }
      if($segmen != ''){ $total_table_1->where('segmen',$segmen); }
      if($segmen_hvc != ''){ $total_table_1->where('segmen',$segmen_hvc); }
      if(in_array($tunggakan,['0','1','2','3','4','5','6'])){ $total_table_1->where('tunggakan',$tunggakan); }
      if($tunggakan == 'Lebih6'){ $total_table_1->where(DB::raw("tunggakan::INT"),'>',6); }

      $total_table_2 = DB::connection('pg19')->table('prediction_ct0_monitor')->select(array(
          'witel_area',
          DB::raw("SUM(CASE WHEN prioritas = '1' THEN 1 ELSE 0 END) AS datapra2"),
          DB::raw("SUM(CASE WHEN cat_zona = 'Green' THEN 1 ELSE 0 END) AS green"),
          DB::raw("SUM(CASE WHEN cat_zona = 'Yellow' THEN 1 ELSE 0 END) AS yellow"),
          DB::raw("SUM(CASE WHEN cat_zona = 'Red' THEN 1 ELSE 0 END) AS red"),
          DB::raw("SUM(CASE WHEN cat_spec = 'UNSPEK' THEN 1 ELSE 0 END) AS unspek"),
          DB::raw("SUM(CASE WHEN cat_ticket = 'TICKETINFRA' THEN 1 ELSE 0 END) AS qjaringan"),
          DB::raw("SUM(CASE WHEN cat_qc = 'BELUM VALID' THEN 1 ELSE 0 END) AS qc2"),
          DB::raw("SUM(CASE WHEN cat_ticket = 'TICKETCC' THEN 1 ELSE 0 END) AS ticket"),
          DB::raw("SUM(CASE WHEN cat_quota = 'OVERQUOTA' THEN 1 ELSE 0 END) AS quota"),
          DB::raw("SUM(CASE WHEN cat_cm = 'CM' THEN 1 ELSE 0 END) AS cm"),
          DB::raw("SUM(1) AS total")
      ))->where('prioritas', '1');
      if($source != ''){ $total_table_2->where('sumber',$source); }
      if($prediction != ''){ $total_table_2->where('prediction',$prediction); }
      if($segmen != ''){ $total_table_2->where('segmen',$segmen); }
      if($segmen_hvc != ''){ $total_table_2->where('segmen',$segmen_hvc); }
      if(in_array($tunggakan,['0','1','2','3','4','5','6'])){ $total_table_2->where('tunggakan',$tunggakan); }
      if($tunggakan == 'Lebih6'){ $total_table_2->where(DB::raw("tunggakan::INT"),'>',6); }

      $data = [
          'total_table_1' => $total_table_1->groupBy('witel_area')->orderBy('witel_area', 'asc')->get(),
          'total_table_2' => $total_table_2->groupBy('witel_area')->orderBy('witel_area', 'asc')->get(),
      ];

      return response()->json($data);
    }
    return view('admin.praNPC.index');
  }

  public function pra_npc_detail(Request $request){
    if($request->ajax()){
      $queryBilling = NewCt0::select('*')->where('prioritas','1');

      if($request->source){
        $queryBilling->where('sumber',$request->source);
      }
      if ($request->prediction) {
          $queryBilling->where('prediction', $request->prediction);
      }
      if ($request->segmen) {
          $queryBilling->where('segmen', $request->segmen);
      }
      if ($request->segmen_hvc) {
          $queryBilling->where('segmen_hvc', $request->segmen_hvc);
      }
      if(in_array($request->tunggakan,['0','1','2','3','4','5','6'])){
          $queryBilling->where('tunggakan',$tunggakan);
      }
      if($request->tunggakan == 'Lebih6'){
          $queryBilling->where(DB::raw("tunggakan::INT"),'>',6);
      }
      if ($request->moving_bill) {
          $queryBilling->where('moving_bill', $request->moving_bill);
      }
      if ($request->witel_area) {
          $queryBilling->where('witel_area', $request->witel_area);
      }
      if ($request->cat_zona) {
          $queryBilling->where('cat_zona', $request->cat_zona);
      }
      if ($request->cat_ticket) {
          $queryBilling->where('cat_ticket', $request->cat_ticket);
      }
      if ($request->cat_spec) {
          $queryBilling->where('cat_spec', $request->cat_spec);
      }
      if ($request->cat_qc) {
          $queryBilling->where('cat_qc', $request->cat_qc);
      }
      if ($request->cat_quota) {
          $queryBilling->where('cat_quota', $request->cat_quota);
      }
      if ($request->cat_cm) {
          $queryBilling->where('cat_cm', $request->cat_cm);
      }

      $table = DataTables::of($queryBilling->get());

      $table->addColumn('placeholder', '&nbsp;');

      $table->addIndexColumn();

      $table->editColumn('notel', function ($row) {
          return $row->notel ?? '';
      });
      $table->editColumn('witel_area', function ($row) {
          return $row->witel_area ?? '';
      });
      $table->editColumn('prediction', function ($row) {
          return $row->prediction ?? '';
      });
      $table->editColumn('probability', function ($row) {
          return $row->probability ?? '';
      });
      $table->editColumn('nper_awal', function ($row) {
          return $row->nper_awal ?? '';
      });
      $table->editColumn('prioritas', function ($row) {
          return $row->prioritas ?? '';
      });
      $table->editColumn('update_nper', function ($row) {
          return $row->update_nper ?? '';
      });
      $table->editColumn('alpro_rxpoweronu', function ($row) {
          return $row->alpro_rxpoweronu ?? '';
      });
      $table->editColumn('alpro_onustatus', function ($row) {
          return $row->alpro_onustatus ?? '';
      });
      $table->editColumn('status_gangguan', function ($row) {
          return $row->status_gangguan ?? '';
      });
      $table->editColumn('usia_ps', function ($row) {
          return $row->usia_ps ?? '';
      });
      $table->editColumn('lcat_name', function ($row) {
          return $row->lcat_name ?? '';
      });
      $table->editColumn('segmen_hvc', function ($row) {
          return $row->segmen_hvc ?? '';
      });
      $table->editColumn('status_qc', function ($row) {
          return $row->status_qc ?? '';
      });
      $table->editColumn('paket_inet', function ($row) {
          return $row->paket_inet ?? '';
      });
      $table->editColumn('psb_channel_sales', function ($row) {
          return $row->psb_channel_sales ?? '';
      });
      $table->editColumn('usage_inet_current_month', function ($row) {
          return $row->usage_inet_current_month ?? '';
      });
      $table->editColumn('usage_bln_lalu', function ($row) {
          return $row->usage_bln_lalu ?? '';
      });
      $table->editColumn('kuota_speed_ncx', function ($row) {
          return $row->kuota_speed_ncx ?? '';
      });
      $table->editColumn('status_fup', function ($row) {
          return $row->status_fup ?? '';
      });
      $table->editColumn('ticketid', function ($row) {
          return $row->ticketid ?? '';
      });
      $table->editColumn('reporttimestamp', function ($row) {
          return $row->reporttimestamp ?? '';
      });
      $table->editColumn('statustimestamp', function ($row) {
          return $row->statustimestamp ?? '';
      });
      $table->editColumn('status', function ($row) {
          return $row->status ?? '';
      });
      $table->editColumn('max_endtime', function ($row) {
          return $row->max_endtime ?? '';
      });
      $table->editColumn('duration_no_usage', function ($row) {
          return $row->duration_no_usage ?? '';
      });
      $table->editColumn('cat_spec', function ($row) {
          return $row->cat_spec ?? '';
      });
      $table->editColumn('cat_ticket', function ($row) {
          return $row->cat_ticket ?? '';
      });
      $table->editColumn('cat_qc', function ($row) {
          return $row->cat_qc ?? '';
      });
      $table->editColumn('cat_quota', function ($row) {
          return $row->cat_quota ?? '';
      });
      $table->editColumn('cat_usage', function ($row) {
          return $row->cat_usage ?? '';
      });
      $table->editColumn('cat_cm', function ($row) {
          return $row->cat_cm ?? '';
      });
      $table->editColumn('moving_bill', function ($row) {
          return $row->moving_bill ?? '';
      });
      $table->editColumn('cat_zona', function ($row) {
          return $row->cat_zona ?? '';
      });
      $table->rawColumns(['placeholder']);

      return $table->make(true);
    }

    return view('admin.praNPC.detail');
  }

  public function pra_npc_detail_download(Request $request){

    return Excel::download(new PraNPCExport($request->all()),'Pra NPC Detail.xlsx');
  }

  public function pra_pra_npc(Request $request){
    if ($request->ajax()) {
        $prediction = '';
        $segmen = '';
        $segmen_hvc = '';
        if ($request->prediction) {
            $prediction = $request->prediction;
        }
        if($request->segmen){
            $segmen = $request->segmen;
        }
        if ($request->segmen_hvc) {
            $segmen_hvc = $request->segmen_hvc;
        }
        $total_witel_tetap = DB::connection('pg19')->table('prediction_ct0_monitor')->select(array(
            'witel_area',
            DB::raw("SUM(CASE WHEN cat_zona = 'Green' THEN 1 ELSE 0 END) AS green"),
            DB::raw("SUM(CASE WHEN cat_zona = 'Yellow' THEN 1 ELSE 0 END) AS yellow"),
            DB::raw("SUM(CASE WHEN cat_zona = 'Red' THEN 1 ELSE 0 END) AS red"),
            DB::raw("SUM(CASE WHEN cat_spec = 'UNSPEK' THEN 1 ELSE 0 END) AS unspek"),
            DB::raw("SUM(CASE WHEN cat_ticket = 'TICKETINFRA' THEN 1 ELSE 0 END) AS qjaringan"),
            DB::raw("SUM(CASE WHEN cat_spec = 'OFFLINE' THEN 1 ELSE 0 END) AS offline"),
            DB::raw("SUM(CASE WHEN cat_qc = 'BELUM VALID' THEN 1 ELSE 0 END) AS qc2"),
            DB::raw("SUM(CASE WHEN cat_ticket = 'TICKETCC' THEN 1 ELSE 0 END) AS ticketcc"),
            DB::raw("SUM(CASE WHEN cat_quota = 'OVERQUOTA' THEN 1 ELSE 0 END) AS overquota"),
            DB::raw("SUM(CASE WHEN cat_usage = 'NOUSAGE' THEN 1 ELSE 0 END) AS nousage"),
            DB::raw("SUM(CASE WHEN cat_cm = 'CM' THEN 1 ELSE 0 END) AS cm"),
            DB::raw("SUM(1) AS sisa_caring"),
        ))->where('prioritas', '2')->where('moving_bill', 'TETAP');
        if($prediction != ''){
            $total_witel_tetap->where('prediction',$prediction);
        }
        if($segmen != ''){
            $total_witel_tetap->where('segmen',$segmen);
        }
        if($segmen_hvc != ''){
            $total_witel_tetap->where('segmen_hvc',$segmen_hvc);
        }

        $total_witel_bergerak = DB::connection('pg19')->table('prediction_ct0_monitor')->select(array(
            'witel_area',
            DB::raw("SUM(CASE WHEN cat_zona = 'Green' THEN 1 ELSE 0 END) AS green"),
            DB::raw("SUM(CASE WHEN cat_zona = 'Yellow' THEN 1 ELSE 0 END) AS yellow"),
            DB::raw("SUM(CASE WHEN cat_zona = 'Red' THEN 1 ELSE 0 END) AS red"),
            DB::raw("SUM(CASE WHEN cat_spec = 'UNSPEK' THEN 1 ELSE 0 END) AS unspek"),
            DB::raw("SUM(CASE WHEN cat_ticket = 'TICKETINFRA' THEN 1 ELSE 0 END) AS qjaringan"),
            DB::raw("SUM(CASE WHEN cat_spec = 'OFFLINE' THEN 1 ELSE 0 END) AS offline"),
            DB::raw("SUM(CASE WHEN cat_qc = 'BELUM VALID' THEN 1 ELSE 0 END) AS qc2"),
            DB::raw("SUM(CASE WHEN cat_ticket = 'TICKETCC' THEN 1 ELSE 0 END) AS ticketcc"),
            DB::raw("SUM(CASE WHEN cat_quota = 'OVERQUOTA' THEN 1 ELSE 0 END) AS overquota"),
            DB::raw("SUM(CASE WHEN cat_usage = 'NOUSAGE' THEN 1 ELSE 0 END) AS nousage"),
            DB::raw("SUM(CASE WHEN cat_cm = 'CM' THEN 1 ELSE 0 END) AS cm"),
            DB::raw("SUM(1) AS sisa_caring"),
        ))->where('prioritas', '2')->where('moving_bill', 'BERGERAK');
        if($prediction != ''){
            $total_witel_bergerak->where('prediction',$prediction);
        }
        if($segmen != ''){
            $total_witel_bergerak->where('segmen',$segmen);
        }
        if($segmen_hvc != ''){
            $total_witel_bergerak->where('segmen_hvc',$segmen_hvc);
        }
        $data = [
            'total_witel_tetap' => $total_witel_tetap->groupBy('witel_area')->orderBy('witel_area', 'asc')->get(),
            'total_witel_bergerak' => $total_witel_bergerak->groupBy('witel_area')->orderBy('witel_area', 'asc')->get(),
        ];

        return response()->json($data);
    }

    return view('admin.praPraNPC.index');
  }

  public function pra_pra_npc_detail(Request $request){
    if ($request->ajax()) {
        $queryBilling = NewCt0::select('*')->where('prioritas','2');

        if ($request->prediction) {
            $queryBilling->where('prediction', $request->prediction);
        }
        if ($request->segmen) {
            $queryBilling->where('segmen', $request->segmen);
        }
        if ($request->segmen_hvc) {
            $queryBilling->where('segmen_hvc', $request->segmen_hvc);
        }
        if ($request->bill) {
            $queryBilling->where('moving_bill', $request->bill);
        }
        if ($request->witel_area) {
            $queryBilling->where('witel_area', $request->witel_area);
        }
        if ($request->cat_zona) {
            $queryBilling->where('cat_zona', $request->cat_zona);
        }
        if ($request->cat_ticket) {
            $queryBilling->where('cat_ticket', $request->cat_ticket);
        }
        if ($request->cat_spec) {
            $queryBilling->where('cat_spec', $request->cat_spec);
        }
        if ($request->cat_qc) {
            $queryBilling->where('cat_qc', $request->cat_qc);
        }
        if ($request->cat_quota) {
            $queryBilling->where('cat_quota', $request->cat_quota);
        }
        if ($request->cat_usage) {
            $queryBilling->where('cat_usage', $request->cat_usage);
        }
        if ($request->cat_cm) {
            $queryBilling->where('cat_cm', $request->cat_cm);
        }
        if ($request->sisa_caring) {
            $queryBilling->orWhere(function ($query) {
                $query->Where('cat_zona', 'Green');
                $query->Where('cat_zona', 'Yellow');
                $query->Where('cat_zona', 'Red');
                $query->Where('cat_ticket', 'TICKETINFRA');
                $query->Where('cat_ticket', 'TICKETCC');
                $query->Where('cat_spec', 'UNSPEK');
                $query->Where('cat_spec', 'OFFLINE');
                $query->Where('cat_qc', 'BELUM VALID');
                $query->Where('cat_quota', 'OVERQUOTA');
                $query->Where('cat_usage', 'NOUSAGE');
                $query->Where('cat_cm', 'CM');
            });
        }
        $table = DataTables::of($queryBilling->get());

        $table->addColumn('placeholder', '&nbsp;');

        $table->addIndexColumn();

        $table->editColumn('notel', function ($row) {
            return $row->notel ?? '';
        });
        $table->editColumn('witel_area', function ($row) {
            return $row->witel_area ?? '';
        });
        $table->editColumn('prediction', function ($row) {
            return $row->prediction ?? '';
        });
        $table->editColumn('probability', function ($row) {
            return $row->probability ?? '';
        });
        $table->editColumn('nper_awal', function ($row) {
            return $row->nper_awal ?? '';
        });
        $table->editColumn('prioritas', function ($row) {
            return $row->prioritas ?? '';
        });
        $table->editColumn('update_nper', function ($row) {
            return $row->update_nper ?? '';
        });
        $table->editColumn('alpro_rxpoweronu', function ($row) {
            return $row->alpro_rxpoweronu ?? '';
        });
        $table->editColumn('alpro_onustatus', function ($row) {
            return $row->alpro_onustatus ?? '';
        });
        $table->editColumn('status_gangguan', function ($row) {
            return $row->status_gangguan ?? '';
        });
        $table->editColumn('usia_ps', function ($row) {
            return $row->usia_ps ?? '';
        });
        $table->editColumn('lcat_name', function ($row) {
            return $row->lcat_name ?? '';
        });
        $table->editColumn('segmen_hvc', function ($row) {
            return $row->segmen_hvc ?? '';
        });
        $table->editColumn('status_qc', function ($row) {
            return $row->status_qc ?? '';
        });
        $table->editColumn('paket_inet', function ($row) {
            return $row->paket_inet ?? '';
        });
        $table->editColumn('psb_channel_sales', function ($row) {
            return $row->psb_channel_sales ?? '';
        });
        $table->editColumn('usage_inet_current_month', function ($row) {
            return $row->usage_inet_current_month ?? '';
        });
        $table->editColumn('usage_bln_lalu', function ($row) {
            return $row->usage_bln_lalu ?? '';
        });
        $table->editColumn('kuota_speed_ncx', function ($row) {
            return $row->kuota_speed_ncx ?? '';
        });
        $table->editColumn('status_fup', function ($row) {
            return $row->status_fup ?? '';
        });
        $table->editColumn('ticketid', function ($row) {
            return $row->ticketid ?? '';
        });
        $table->editColumn('reporttimestamp', function ($row) {
            return $row->reporttimestamp ?? '';
        });
        $table->editColumn('statustimestamp', function ($row) {
            return $row->statustimestamp ?? '';
        });
        $table->editColumn('status', function ($row) {
            return $row->status ?? '';
        });
        $table->editColumn('max_endtime', function ($row) {
            return $row->max_endtime ?? '';
        });
        $table->editColumn('duration_no_usage', function ($row) {
            return $row->duration_no_usage ?? '';
        });
        $table->editColumn('cat_spec', function ($row) {
            return $row->cat_spec ?? '';
        });
        $table->editColumn('cat_ticket', function ($row) {
            return $row->cat_ticket ?? '';
        });
        $table->editColumn('cat_qc', function ($row) {
            return $row->cat_qc ?? '';
        });
        $table->editColumn('cat_quota', function ($row) {
            return $row->cat_quota ?? '';
        });
        $table->editColumn('cat_usage', function ($row) {
            return $row->cat_usage ?? '';
        });
        $table->editColumn('cat_cm', function ($row) {
            return $row->cat_cm ?? '';
        });
        $table->editColumn('moving_bill', function ($row) {
            return $row->moving_bill ?? '';
        });
        $table->editColumn('cat_zona', function ($row) {
            return $row->cat_zona ?? '';
        });
        $table->rawColumns(['placeholder']);

        return $table->make(true);
      }

      return view('admin.praPraNPC.detail');
  }

  public function pra_pra_npc_detail_download(Request $request){

      return Excel::download(new PraPraNPCExport($request->all()),'Pra Pra NPC Detail.xlsx');
  }

}
