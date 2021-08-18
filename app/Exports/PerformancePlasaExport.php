<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PerformancePlasaExport implements FromCollection, WithHeadings
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
        $addon = $data['addon'];

        $collection = new Collection();

        $dt_query = DB::connection('pg11')->table('plasa_rekap_gabungan_detail_v2')
                                        ->select('*')
                                        ->whereIn('addon', ['MIG2P3P', 'MINIPACK', 'STB2', 'UPSPEED', 'OTT']);
        $dt_query2 = DB::connection('pg11')->table('plasa_rekap_gabungan_detail_v2')
                                        ->select(DB::raw('DISTINCT *'))
                                        ->whereIn('addon', ['psb_nonkios_csr', 'psb_kios_csr','psb_kios_mesin']);
        $query = $dt_query->unionAll($dt_query2)->get();
        if ($periode != "ALL_PERIODE") {
            $query = $query->where('report_month', $periode);
        }
        if ($witel != "ALL_WITEL") {
            $query = $query->where('witel', $witel);
        }
        if ($plasa == "null") {
            $query = $query->whereNull('plasa');
        }
        if ($plasa != "ALL" && $plasa != "null") {
            $query = $query->where('plasa', $plasa);
        }
        if ($addon != "ALL_ADDON") {
            $query = $query->where('addon', $addon);
        }

        $value = $query;

        foreach ($value as $row) {
            $collection->push((object)[
                'report_month' => $row->report_month,
                'nd_speedy' => $row->nd_speedy,
                'kode_sales_v2' => $row->kode_sales_v2,
                'nama' => $row->nama,
                'witel' => $row->witel,
                'plasa' => $row->plasa,
                'sto' => $row->sto,
                'addon' => $row->addon,
                'ccat' => $row->ccat,
                'coper' => $row->coper,
                'kcontact' => $row->kcontact,
                'tgl_ps' => $row->tgl_ps
            ]);
        }
        return $collection;
    }

    public function headings(): array
    {
        return [
            'REPORT MONTH',
            'NO INET',
            'KODE SALES',
            'NAMA SALES',
            'WITEL',
            'PLASA',
            'STO',
            'ADDON',
            'CCAT',
            'COPER',
            'KCONTACT',
            'TGL PS'
        ];
    }
}
