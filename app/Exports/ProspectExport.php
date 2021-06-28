<?php

namespace App\Exports;

use App\Models\MasterDataTreg;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProspectExport implements FromCollection, WithHeadings, ShouldQueue 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    function __construct($value)
    {
        $this->value = $value;
    }

    public function collection()
    {
        $data = $this->value;
        // $prospectData = Cache::get('prospectData');
        // $value = $prospectData->whereIn('witel', $data['witel']);    
        // $value = MasterDataTreg::select('notel', 'witel', 'no_hp', 'email_myih')->whereIn('witel', $data['witel']);
        $value = MasterDataTreg::select('notel', 'witel', 'no_hp', 'email_myih', 'linecats_item_id', 'revenue_trems', '1p_2p_3p')->where('is_lis',1);
        if (isset($data['witel'])) {
            $value->whereIn('witel_str', $data['witel']);
        }
        if (isset($data['indihome'])) {
            $value->whereIn('is_indihome', $data['indihome']);
        }
        if (isset($data['customer'])) {
            $value->whereIn('plblcl_trems', $data['customer']);
        }
        if (isset($data['useetv'])) {
            $value->whereIn('jenis_useetv', $data['useetv']);
        }
        if (isset($data['gangguan'])) {
            $value->whereIn('status_gangguan', $data['gangguan']);
        }
        // if(isset($data['minipack']))
        // {                
        //     foreach ($data['minipack'] as $minipack) {
        //         if ($minipack == 'mp_combo_sport') {                            
        //             $value->Where('mp_combo_sport', 'OK');  
        //         }
        //         if ($minipack == 'mp_dynasti_2') {                            
        //             $value->Where('mp_dynasti_2', 'OK');  
        //         }
        //         if ($minipack == 'mp_essential') {                            
        //             $value->Where('mp_essential', 'OK');  
        //         }
        //         if ($minipack == 'mp_extra_hd') {                            
        //             $value->Where('mp_extra_hd', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_action') {                            
        //             $value->Where('mp_indi_action', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_basketball') {                            
        //             $value->Where('mp_indi_basketball', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_golf') {                            
        //             $value->Where('mp_indi_golf', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_japan') {                            
        //             $value->Where('mp_indi_japan', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_jowo') {                            
        //             $value->Where('mp_indi_jowo', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_kids') {                            
        //             $value->Where('mp_indi_kids', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_kids_bright') {                            
        //             $value->Where('mp_indi_kids_bright', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_kids_fun') {                            
        //             $value->Where('mp_indi_kids_fun', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_kids_joy') {                            
        //             $value->Where('mp_indi_kids_joy', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_kids_lite') {                            
        //             $value->Where('mp_indi_kids_lite', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_korea') {                            
        //             $value->Where('mp_indi_korea', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_movie_1') {                            
        //             $value->Where('mp_indi_movie_1', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_movie_1_lite') {                            
        //             $value->Where('mp_indi_movie_1_lite', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_movie_2') {                            
        //             $value->Where('mp_indi_movie_2', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_news') {                            
        //             $value->Where('mp_indi_news', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_sport_2') {                            
        //             $value->Where('mp_indi_sport_2', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_tainment_1') {                            
        //             $value->Where('mp_indi_tainment_1', 'OK');  
        //         }
        //         if ($minipack == 'mp_indi_tainment_2') {                            
        //             $value->Where('mp_indi_tainment_2', 'OK');  
        //         }
        //         if ($minipack == 'mp_konser') {                            
        //             $value->Where('mp_konser', 'OK');  
        //         }
        //         if ($minipack == 'mp_sport') {                            
        //             $value->Where('mp_sport', 'OK');  
        //         }
        //     }                             
        // }
        return $value->cursor();
    }

    public function headings(): array
    {
        return [
            'NOTEL',
            'WITEL',
            'NO HP',
            'EMAIL', 
            'LCAT', 
            'TAGIHAN',
            'JENIS PELANGGAN',
        ];
    }
}
