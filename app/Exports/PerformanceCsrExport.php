<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PerformanceCsrExport implements FromCollection, WithHeadings
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function collection()
    {
        $data = $this->value; 
        
        $periode = $data['periode'];   
        $witel = $data['witel'];   
        $plasa = $data['plasa'];  
        
        $collection = new Collection();

        $dt_query = DB::connection('pg11')->table('plasa_addon_rekap_fix')
        ->select(
            'kode_sales_v2', 'nama', 'witel', 'plasa', 'status',
            DB::raw("sum(mig2p3p) as mig2p3p"),
            DB::raw("sum(minipack) as minipack"),
            DB::raw("sum(stb_tambahan) as stb_tambahan"),
            DB::raw("sum(upgrade_speed) as upgrade_speed"),
            DB::raw("sum(ott) as ott"),
            DB::raw("sum(psb_2p) as psb_2p"),
            DB::raw("sum(psb_3p) as psb_3p"),
            DB::raw("sum(mig2p3p+minipack+stb_tambahan+upgrade_speed+ott+psb_2p+psb_3p) as total"),
        );

        if ($periode == "ALL_PERIODE") {
            $dt_query = $dt_query;
        } else {
            $dt_query = $dt_query->where('report_month', $periode);
        }

        if ($witel == "ALL_WITEL") {
            $dt_query = $dt_query;
        } else {
            $dt_query = $dt_query->where('witel', $witel);
        }

        if ($plasa == "ALL") {
            $dt_query = $dt_query;
        } else if ($plasa == "null") {
            $dt_query = $dt_query->whereNull('plasa');
        } else {
            $dt_query = $dt_query->where('plasa', $plasa);
        }

        $value = $dt_query->groupBy('witel', 'plasa', 'kode_sales_v2', 'nama', 'status')->get();

        foreach ($value as $row) {
            $collection->push((object)[
                'kode_sales_v2' => $row->kode_sales_v2,
                'nama' => $row->nama,
                'witel' => $row->witel,
                'plasa' => $row->plasa,             
                'status' => $row->status,
                'mig2p3p' => $row->mig2p3p,
                'minipack' => $row->minipack,
                'stb_tambahan' => $row->stb_tambahan,
                'upgrade_speed' => $row->upgrade_speed,
                'ott' => $row->ott,
                'psb_2p' => $row->psb_2p,
                'psb_3p' => $row->psb_3p,
                'total' => $row->total     
            ]);
        }
        return $collection;
    }

    public function headings(): array
    {
        return [
            'KODE SALES',
            'NAMA SALES',
            'WITEL',
            'PLASA',
            'STATUS',
            'MIG2P3P',
            'MINIPACK',
            'STB TAMBAHAN',
            'UPGRADE SPEED',
            'OTT',
            'PSB 2P',
            'PSB 3P',
            'TOTAL'
        ];
    }
}
