<?php

namespace App\Exports;

use App\Models\MigHomeWifi;
use App\Models\MigNonIndibox;
use App\Models\StbTambahan;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportPedExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
    
    public function collection()
    {
        //
        $data = $this->value;       
        $tahun = $data['tahun'] ?? '';
        $bln = $data['bln'] ?? '';
        $addon = $data['addon'] ?? '';
        $witel = $data['witel'] ?? '';
        $collection = new Collection(); 
        
        if($addon == "MIGHW2P"){
            $query = MigHomeWifi::select('ndinet','ndem','kcontact','chanel','ccat','addon','tematik','item','cpack','price_psb','report_month')->whereRaw("LEFT(report_month,4)='$tahun'");
        }
        else if($addon == "MIG2P3P")
        {
            $query = MigNonIndibox::select('ndinet','ndem','kcontact','chanel','ccat','addon','tematik','item','cpack','price_psb','report_month')->whereRaw("LEFT(report_month,4)='$tahun'");
        }
        else if($addon == "STB2"){
            $query = StbTambahan::select('ndinet','ndem','kcontact','chanel','ccat','addon','tematik','item','cpack','price_psb','report_month')->whereRaw("LEFT(report_month,4)='$tahun'");
        }

        if($bln != '')
        {
            $query->whereRaw("RIGHT(report_month,2)='$bln'");
        }

        if($witel != '')
        {
            $query->where('c_witel',$witel);
        }
        
        $value = $query->where('addon',$addon)->where('psb',1)->cursor();        
        
        foreach ($value as $row) {
            $collection->push((object)[
                'ndinet' => $row->ndinet,
                'addon' => $row->addon,
                'ndem' => $row->ndem,
                'kcontact' => $row->kcontact,
                'chanel' => $row->chanel,
                'ccat' => $row->ccat,
                'tematik' => $row->tematik,
                'item' => $row->item,
                'cpack' => $row->cpack,
                'price_psb' => $row->price_psb,
            ]);
        }
        return $collection;
    }
    
    public function headings(): array
    {
        return [
            'NO INET',
            'ADDON',
            'NDEM',
            'KCONTACT',
            'CHANNEL',
            'CCAT',
            'TEMATIK',
            'ITEM',
            'CPACK',
            'PRICE PSB',
        ];
    }
}
