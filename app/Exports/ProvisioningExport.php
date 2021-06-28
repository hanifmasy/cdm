<?php

namespace App\Exports;

use App\Models\ScAddonStatus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class ProvisioningExport implements FromCollection, WithHeadings
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function collection()
    {
        $data = $this->value; 
        
        $addon = $data['addon'];   
        $segmen = $data['segmen'];        

        $collection = new Collection(); 

        $query = ScAddonStatus::select(
            "order_id", "internet", "pots", "nama_pelanggan", "no_hp", "witel_str", 
            "sto_str", "item", "status_order", "kcontact", "lcat_name", "segmen", "durasijam", "speed_before", 
            "speed_req", "plclbl_trems", "ccat", "create_dtm", "update_dtm"
        );       
            
        if ($addon == "ALL_ADDON") {
            $query = $query->where(function ($query) {
                $query->orwhere("minipack", 'OK')
                ->orwhere("upgrade", 'OK')
                ->orWhere("mig2p3p", 'OK')
                ->orWhere("stb_tambahan", 'OK')
                ->orWhere("plc", 'OK')
                ->orWhere("mig1p2p", 'OK');
            })                  
            ->whereNotNull('status_order')
            ->whereNotNull('witel_str')
            ->whereNotNull('witel');                
        } else {
            $query = $query->where("$addon", 'OK');
        }

        if ($segmen == "ALL_SEGMEN") {
            $query = $query;
        } else {
            $query = $query->where('plclbl_trems', $segmen);
        }
            
        if ($data['witel'] == "ALL") {
            $query = $query;
        } else {
            $query = $query->where('witel_str', $data['witel']);    
        }

        if ($data['status'] == "ALL_STATUS") {               
            $query = $query->where(DB::raw('upper(status_order)'), 'NOT LIKE', '%CANCEL%')
            ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%EAI  WAIT FOR EAI PROGRESS%')
            ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%EAI  COMPLETED%')
            ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%TSEL%')
            ->Where(DB::raw('upper(status_order)'), 'NOT LIKE', '%SOA%');
        } else {
            $query = $query->where('status_order', $data['status']);
        }

        $value = $query->get();        

        foreach ($value as $row) {
            $collection->push((object)[
                'order_id' => $row->order_id,
                'internet' => $row->internet,
                'pots' => $row->pots,
                'nama_pelanggan' => $row->nama_pelanggan,
                'no_hp' => $row->no_hp,
                'witel_str' => $row->witel_str,
                'sto_str' => $row->sto_str,
                'item' => $row->item,
                'status_order' => $row->status_order,
                'kcontact' => $row->kcontact,
                'segmen' => $row->segmen,
                'lcat_name' => $row->lcat_name,
                'ccat' => $row->ccat,
                'plclbl_trems' => $row->plclbl_trems,
                'durasijam' => $row->durasijam,
                'speed_before' => $row->speed_before,
                'speed_req' => $row->speed_req,
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
            'NAMA PELANGGAN',
            'NO HP',
            'WITEL',
            'STO',
            'ITEM',
            'STATUS ORDER',
            'KCONTACT',
            'SEGMEN',
            'LCAT NAME', 
            'CCAT',
            'SEGMEN PELANGGAN',  
            'DURASI JAM',
            'SPEED BEFORE',
            'SPEED REQUEST',
            'CREATED DATE',           
            'STATUS UPDATE'
        ];
    }
}
