<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PerformanceCsrdetailExport implements FromCollection, WithHeadings
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
        $csr = $data['csr']; 

        $collection = new Collection();

        $dt_query = DB::connection('pg11')->table('plasa_rekap_gabungan_detail');

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

        if ($addon == "ALL_ADDON") {
            $dt_query = $dt_query->whereIn('addon', ['MIG2P3P', 'MINIPACK', 'STB2', 'UPSPEED', 'OTT', 'psb_2p', 'psb_3p']);
        } else {
            $dt_query = $dt_query->where('addon', $addon);
        }

        if ($csr != "") {
            $dt_query = $dt_query->where('kode_sales_v2', $csr);
        }

        $value = $dt_query->get();  

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
