<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class SfGoproExport implements FromCollection, WithHeadings
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function collection()
    {
        $data = $this->value; 
        
        $witel = $data['witel'];   
        $channel = $data['channel'];   
        $addon = $data['addon'];   
        $dapros = $data['dapros']; 

        $collection = new Collection();
        $dt_query = DB::connection('pg10')->table('dapros_status_fixed')
        ->select(
            "seller_id", "name", "witel_str", "datel", "current_total_price", "current_package", 
            "usee_tv", "promo", "subscription_month", "created_at", "updated_time", "channel", 
            "offer_type", "followup_time", "nama_seller"
        )
        ->whereNotNull('channel')
        ->whereNotNull('witel_str')
        ->whereNotNull('offer_type');

        if ($witel == "ALL_WITEL") {
            $dt_query = $dt_query;
        } else {
            $dt_query = $dt_query->where('witel_str', $witel);
        }

        if ($channel == "ALL") {
            $dt_query = $dt_query;
        } else {
            $dt_query = $dt_query->where('channel', $channel);
        } 

        if ($addon == "ALL_ADDON") {
            $dt_query = $dt_query;
        } else {
            $dt_query = $dt_query->where('offer_type', $addon);
        }

        if ($dapros == "SISA_DAPROS") {
            $dt_query = $dt_query->whereNull('followup_time');
        } else if ($dapros == "FOLLOWUP_DAPROS") {
            $dt_query = $dt_query->whereNotNull('followup_time');
        } else {
            $dt_query = $dt_query;
        }

        $value = $dt_query->get();  

        foreach ($value as $row) {
            $collection->push((object)[
                'seller_id' => $row->seller_id,
                'name' => $row->name,
                'witel_str' => $row->witel_str,
                'datel' => $row->datel,
                'current_total_price' => $row->current_total_price,                
                'current_package' => $row->current_package,
                'usee_tv' => $row->usee_tv,
                'promo' => $row->promo,
                'subscription_month' => $row->subscription_month,
                'created_at' => $row->created_at,
                'updated_time' => $row->updated_time,
                'channel' => $row->channel,
                'offer_type' => $row->offer_type,                
                'followup_time' => $row->followup_time,
                'nama_seller' => $row->nama_seller            
            ]);
        }
        return $collection;

    }

    public function headings(): array
    {
        return [
            'SELLER ID',
            'NAMA PELANGGAN',
            'WITEL',
            'DATEL',
            'CURRENT TOTAL PRICE',
            'CURRENT PACKAGE',
            'USEETV',
            'PROMO',
            'SUBSCRIPTION MONTH',
            'CHANNEL',
            'OFFER TYPE',
            'FOLLOW UP DATE',           
            'NAMA SELLER',
            'CREATED DATE',
            'STATUS UPDATE' 
        ];
    }
}
