<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PsbAllSegmenExport implements FromCollection, WithHeadings
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
      $column = $data['column'];

      $collection = new Collection();

      $query = DB::connection('pg20')->table('channel_psb_distinct_fixed')
      ->select('*');

      if($periode == "ALLPERIODE"){
          $query = $query->where(DB::raw("TO_CHAR(tgl_ps,'YYYYMM'::TEXT)"),'>=','202101');
      }
      if($periode != "ALLPERIODE"){
          $query = $query->where(DB::raw("TO_CHAR(tgl_ps,'YYYYMM'::TEXT)"),'=',$periode);
      }

      if($witel == "BALIKPAPAN"){$query = $query->where('c_witel','=','45');}
      if($witel == "KALBAR"){$query = $query->where('c_witel','=','42');}
      if($witel == "KALTENG"){$query = $query->where('c_witel','=','43');}
      if($witel == "KALSEL"){$query = $query->where('c_witel','=','44');}
      if($witel == "KALTARA"){$query = $query->where('c_witel','=','47');}
      if($witel == "SAMARINDA"){$query = $query->where('c_witel','=','46');}

      if($column == "pl"){$query = $query->where('cseg','=','1');}
      if($column == "bl"){$query = $query->where('cseg','=','2');}
      if($column == "cl"){$query = $query->where('cseg','=','3');}
      if($column == "gl"){$query = $query->where('cseg','=','4');}

      $query = $query->where(DB::raw("ccat::TEXT"),'<>',DB::raw("ALL (ARRAY['400'::CHARACTER VARYING::TEXT, '401'::CHARACTER VARYING::TEXT, '402'::CHARACTER VARYING::TEXT, '403'::CHARACTER VARYING::TEXT, '600'::CHARACTER VARYING::TEXT])"))
      ->where(DB::raw("coper::TEXT"),'=',DB::raw(" '1'::TEXT "));

      $value = $query->get();

      foreach ($value as $row) {
          $collection->push((object)[
              'ncli' => $row->ncli,
              'ndos' => $row->ndos,
              'ndem' => $row->ndem,
              'etat' => $row->etat,
              'cagent' => $row->cagent,
              'kcontact' => $row->kcontact,
              'nd_speedy' => $row->nd_speedy,
              'desc_pack' => $row->desc_pack,
              'coper' => $row->coper,
              'c_witel' => $row->c_witel,
              'sto' => $row->sto,
              'nd_contact' => $row->nd_contact,
              'status' => $row->status,
              'cseg' => $row->cseg,
              'chanel' => $row->chanel,
              'user_id' => $row->user_id,
              'kode_sales' => $row->kode_sales,
              'hape_kcontact' => $row->hape_kcontact,
              'c_sebab' => $row->c_sebab,
              'sebab' => $row->sebab,
              'ket_sebab' => $row->ket_sebab,
              'c_solusi' => $row->c_solusi,
              'solusi' => $row->solusi,
              'ket_solusi' => $row->ket_solusi,
              'id_alpro' => $row->id_alpro,
              'is_ct0' => $row->is_ct0,
              'cpack' => $row->cpack,
              'usage_speedy' => $row->usage_speedy,
              'usage_useetv' => $row->usage_useetv,
              'tgl_ps' => $row->tgl_ps,
          ]);
      }
      return $collection;
  }

  public function headings(): array
  {
      return [
'NCLI',
'NDOS',
'NDEM',
'ETAT',
'CAGENT',
'KCONTACT',
'ND_SPEEDY',
'DESC_PACK',
'COPER',
'C_WITEL',
'STO',
'ND_CONTACT',
'STATUS',
'CSEG',
'CHANEL',
'USER_ID',
'KODE_SALES',
'HAPE_KCONTACT',
'C_SEBAB',
'SEBAB',
'KET_SEBAB',
'C_SOLUSI',
'SOLUSI',
'KET_SOLUSI',
'ID_ALPRO',
'IS_CT0',
'CPACK',
'USAGE_SPEEDY',
'USAGE_USEETV',
'TGL_PS'
      ];
  }
}
