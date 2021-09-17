<?php

namespace App\Exports;

use App\Models\NewCt0;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class NewCt0Export implements FromCollection, WithHeadings
{
  protected $value;
  /**
   * @return \Illuminate\Support\Collection
   */
  public function __construct($value)
  {
    $this->value = $value;
  }

  public function collection()
  {
    $data = $this->value;

    $collection = new Collection();
    $dt_query = NewCt0::select('*');
    if (!empty($data['prioritas'])) {
      $dt_query->where('prioritas', $data['prioritas']);
    }
    if (!empty($data['segmen_hvc'])) {
      $dt_query->where('segmen_hvc', $data['segmen_hvc']);
    }
    if (!empty($data['bill'])) {
      $dt_query->where('moving_bill', $data['bill']);
    }
    if (!empty($data['witel_area'])) {
      $dt_query->where('witel_area', $data['witel_area']);
    }
    if (!empty($data['cat_zona'])) {
      $dt_query->where('cat_zona', $data['cat_zona']);
    }
    if (!empty($data['cat_spec'])) {
      $dt_query->where('cat_spec', $data['cat_spec']);
    }
    if (!empty($data['cat_qc'])) {
      $dt_query->where('cat_qc', $data['cat_qc']);
    }
    if (!empty($data['cat_ticket'])) {
      $dt_query->where('cat_ticket', $data['cat_ticket']);
    }
    if (!empty($data['cat_quota'])) {
      $dt_query->where('cat_quota', $data['cat_quota']);
    }
    if (!empty($data['cat_usage'])) {
      $dt_query->where('cat_usage', $data['cat_usage']);
    }
    if (!empty($data['cat_cm'])) {
      $dt_query->where('cat_cm', $data['cat_cm']);
    }
    if (!empty($data['sisa_caring'])) {
      $dt_query->orWhere(function ($query) {
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

    $value = $dt_query->get();
    foreach ($value as $row) {
      $collection->push((object)[
        'notel' => $row->notel,
        'witel_area' => $row->witel_area,
        'prediction' => $row->prediction,
        'probability' => $row->probability,
        'nper_awal' => $row->nper_awal,
        'prioritas' => $row->prioritas,
        'update_nper' => $row->update_nper,
        'alpro_rxpoweronu' => $row->alpro_rxpoweronu,
        'alpro_onustatus' => $row->alpro_onustatus,
        'status_gangguan' => $row->status_gangguan,
        'usia_ps' => $row->usia_ps,
        'lcat_name' => $row->lcat_name,
        'segmen_hvc' => $row->segmen_hvc,
        'status_qc' => $row->status_qc,
        'paket_inet' => $row->paket_inet,
        'psb_channel_sales' => $row->psb_channel_sales,
        'usage_inet_current_month' => $row->usage_inet_current_month,
        'usage_bln_lalu' => $row->usage_bln_lalu,
        'kuota_speed_ncx' => $row->kuota_speed_ncx,
        'status_fup' => $row->status_fup,
        'ticketid' => $row->ticketid,
        'reporttimestamp' => $row->reporttimestamp,
        'statustimestamp' => $row->statustimestamp,
        'status' => $row->status,
        'max_endtime' => $row->max_endtime,
        'duration_no_usage' => $row->duration_no_usage,
        'cat_spec' => $row->cat_spec,
        'cat_ticket' => $row->cat_ticket,
        'cat_qc' => $row->cat_qc,
        'cat_quota' => $row->cat_quota,
        'cat_usage' => $row->cat_usage,
        'cat_cm' => $row->cat_cm,
        'moving_bill' => $row->moving_bill,
        'cat_zona' => $row->cat_zona
      ]);
    }
    return $collection;
  }

  public function headings(): array
  {
    return [
      'NOTEL',
      'WITEL AREA',
      'PREDICTION',
      'PROBABILITY',
      'NPER AWAL',
      'PRIORITAS',
      'UPDATE_NPER',
      'ALPRO RXPOWERONU',
      'ALPRO ONUSTATUS',
      'STATUS GANGGUAN',
      'USIA PS',
      'LCAT NAME',
      'SEGMEN HVC',
      'STATUS QC',
      'PAKET INET',
      'PSB CHANNEL SALES',
      'USAGE INET CURRENT MONTH',
      'USAGE BULAN LALU',
      'KUOTA SPEED NCX',
      'STATUS FUP',
      'TICKET ID',
      'REPORT TIMESTAMP',
      'STATUS TIMESTAMP',
      'STATUS',
      'MAX ENDTIME',
      'DURATION NO USAGE',
      'CAT SPEC',
      'CAT TICKET',
      'CAT QC',
      'CAT QUOTA',
      'CAT USAGE',
      'CAT CM',
      'MOVING BILL',
      'CAT ZONA',
    ];
  }
}
