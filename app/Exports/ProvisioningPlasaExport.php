<?php

namespace App\Exports;

use App\Models\ScPlasa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ProvisioningPlasaExport implements FromCollection, WithHeadings
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function collection()
    {
        $data = $this->value; 
        
        $order = $data['order'];   
        $periode = $data['periode'];   
        $witel = $data['witel'];   
        $status = $data['status']; 

        $collection = new Collection();   
        $query = ScPlasa::whereNotNull('witel_str')
            ->whereNotNull('status_order')
            ->where(DB::raw("TO_CHAR(create_dtm, 'YYYYMM')"), $periode);
        
        if ($order == "ALL_ORDER") {
            $query = $query;
        } else {
            $query = $query->where('order_type_id', $order);
        }

        if ($witel == "ALL") {
            $query = $query;
        } else {
            $query = $query->where('witel_str', $witel);
        }

        if ($status == "COMPLETED") {
            $query = $query->where('status_order', '13  EAI  COMPLETED');
        } else if ($status == "CANCEL") {                
            $query = $query->where(DB::raw('upper(status_order)'), 'like', "%" . "CANCEL" . "%");
        } else if ($status == "IN_PROGRESS"){
            $query = $query->where(DB::raw('upper(status_order)'), 'not like', "%" . "CANCEL" . "%")
                ->where('status_order', '!=', '13  EAI  COMPLETED');
        } else {
            $query = $query;
        }

        $value = $query->get();        

        foreach ($value as $row) {
            $collection->push((object)[
                'order_id' => $row->order_id,
                'internet' => $row->internet,
                'pots' => $row->pots,
                'create_user_id' => $row->create_user_id,
                'nama_pelanggan' => $row->nama_pelanggan,                
                'witel_str' => $row->witel_str,
                'sto' => $row->sto,
                'item' => $row->item,
                'status_order' => $row->status_order,
                'kcontact' => $row->kcontact,
                'lcat' => $row->lcat,
                'durasijam' => $row->durasijam,
                'order_type_id' => $row->order_type_id,                
                'create_dtm' => $row->create_dtm,
                'update_dtm' => $row->update_dtm            
            ]);
        }
        return $collection;
    }

    public function headings(): array
    {
        return [
            'ORDER ID',
            'NO INET',
            'POTS',
            'CREATED USER ID',
            'NAMA PELANGAAN',
            'WITEL',
            'STO',
            'ITEM',
            'STATUS ORDER',
            'KCONTACT',
            'LCAT', 
            'DURASI JAM',
            'ORDER TYPE ID',
            'CREATED DATE',           
            'STATUS UPDATE'
        ];
    }
}
