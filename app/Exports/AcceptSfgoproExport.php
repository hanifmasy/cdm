<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AcceptSfgoproExport implements FromCollection, WithHeadings
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
	    $witel = $data['witel'];
      $tahun = $data['tahun'];
      $bulan = $data['bulan'];

      $collection = new Collection();
      $dt_query = DB::connection('pg10')->table('accepted_offers')
			->join('customers','accepted_offers.customer_id','=','customers.id')
            ->select(
             'accepted_offers.*','customers.witel'
            );
	  if($witel != "all_w"){
		  $dt_query = $dt_query->where('customers.witel',$witel);
	  }
	  if($tahun != "all_y"){

		   $dt_query = $dt_query->where(
				DB::raw("TO_CHAR(accepted_offers.created_at,'yyyy'::text)"),
				$tahun
		  );
	  }
	  if($bulan != "all_m"){
		  $dt_query = $dt_query->where(
				DB::raw("TO_CHAR(accepted_offers.created_at,'mm'::text)"),
				$bulan
		  );
	  }
	  $value = $dt_query->get();
      foreach($value as $row){
        $collection->push((object)[
            'id' => $row->id,
            'customer_id' => $row->customer_id,
            'seller_id' => $row->seller_id,
            'from_package' => $row->from_package,
            'from_price' => $row->from_price,
            'offer_type' => $row->offer_type,
            'offer_subtype' => $row->offer_subtype,
            'offer_price' => $row->offer_price,
            'status' => $row->status,
            'order_status' => $row->order_status,
            'sc_number' => $row->sc_number,
            'message' => $row->message,
            'source' => $row->source,
            'source_phone' => $row->source_phone,
            'attachment' => $row->attachment,
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
            'updatetime' => $row->updatetime,
            'primarykey' => $row->primarykey,
			      'witel' => $row->witel
        ]);
      }
      return $collection;
    }

    public function headings(): array
        {
            return [
                'ID',
                'CUSTOMER ID',
                'SELLER ID',
                'PACKAGE',
                'PRICE',
                'OFFER TYPE',
                'OFFER SUBTYPE',
                'OFFER PRICE',
                'STATUS',
                'ORDER STATUS',
                'SC NUMBER',
                'MESSAGE',
                'SOURCE',
                'SOURCE PHONE',
                'ATTACHMENT',
                'CREATED AT',
                'UPDATED AT',
                'UPDATETIME',
                'PRIMARYKEY',
				        'WITEL'
            ];
        }
}
