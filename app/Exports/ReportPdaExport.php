<?php

namespace App\Exports;

use App\Models\ReportPda;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportPdaExport implements FromCollection, WithHeadings
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
        $witel = $data['witel'] ?? '';
        $collection = new Collection(); 

        $query = ReportPda::select('order_id','customer_desc','create_user_id','witel_master','internet','segmen','plblcl_trems','ccat','alamat_manual','alamat_sistem','update_dtm')->whereRaw("to_char(update_dtm,'yyyy')='$tahun'");
        if($bln != '')
        {
            $query->whereRaw("to_char(update_dtm,'mm')='$bln'");
        }

        if($witel != ''){
            $query->where('witel_master',$witel);
        }

        $value = $query->whereIntegerInRaw('order_type_id',['124','125'])->where('status_order','13  EAI  COMPLETED')->cursor();

        foreach ($value as $row) {
            $collection->push((object)[
                'order_id' => $row->order_id,
                'customer_desc' => $row->customer_desc,
                'create_user_id' => $row->create_user_id,
                'witel_master' => $row->witel_master,
                'internet' => $row->internet,
                'segmen' => $row->segmen,
                'plblcl_trems' => $row->plblcl_trems,
                'ccat' => $row->ccat,
                'alamat_manual' => $row->alamat_manual,
                'alamat_sistem' => $row->alamat_sistem,
                'update_dtm' => $row->update_dtm,
            ]);
        }
        return $collection;
    }

    public function headings(): array
    {
        return [
            'NO SC',
            'NAMA CUSTOMER',
            'KODE SALES',
            'WITEL',
            'NO INET',
            'SEGMEN',
            'TYPE',
            'CCAT',
            'ALAMAT MANUAL',
            'ALAMAT SISTEM',
            'TANGGAL PS',
        ];
    }
}
