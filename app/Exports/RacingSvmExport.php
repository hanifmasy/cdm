<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class RacingSvmExport implements FromCollection, WithHeadings
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
        $data = $this->value;        
        
        $collection = new Collection();   
        $query = DB::connection('pg14')->table('psb_join_svm_fraud_fixed')
        ->select(
            "nd_speedy", "inet_telp", "nama", "hape", "email", "witel", "agency", "chanel", "status_demand", "citem_speedy", 
            "desc_pack_speedy", "reg_date", "tgl_ps", "channel_kcontack", "status_svm", "hp_kcontact", "status_svm_fraud"
        )
        ->where(DB::raw("TO_CHAR(tgl_ps, 'YYYYMM')"), $data['blnpsb'])
        ->where('witel', $data['witel']);    
                
        if ($data['svm'] == "ALL") {
            $query = $query;
        } elseif ($data['svm'] == "NULL") {
            $query = $query->whereNull('status_svm_fraud');
        } else {
            $query = $query->where('status_svm_fraud', $data['svm']);
        }

        $value = $query->get();        
        
        foreach ($value as $row) {
            $collection->push((object)[
                'nd_speedy' => $row->nd_speedy,
                'inet_telp' => $row->inet_telp,
                'nama' => $row->nama,
                'hape' => $row->hape,
                'hp_kcontact' => $row->hp_kcontact,           
                'email' => $row->email,
                'witel' => $row->witel,
                'agency' => $row->agency,
                'chanel' => $row->chanel,
                'status_demand' => $row->status_demand,
                'citem_speedy' => $row->citem_speedy,
                'desc_pack_speedy' => $row->desc_pack_speedy,
                'reg_date' => $row->reg_date,
                'tgl_ps' => $row->tgl_ps,
                'channel_kcontack' => $row->channel_kcontack,
                'status_svm' => $row->status_svm_fraud,
            ]);
        }
        return $collection;
    }

    public function headings(): array
    {
        return [
            'ND SPEEDY',
            'INET TELP',
            'NAMA',
            'NO HP',
            'HP KCONTACT',
            'EMAIL',
            'WITEL',
            'AGENCY',
            'CHANNEL',
            'STATUS DEMAND',
            'CITEM SPEEDY',
            'DESC PACK SPEEDY',
            'REG DATE',
            'TGL PS',
            'CHANNEL KCONTACT',
            'STATUS SVM'
        ];
    }
}
