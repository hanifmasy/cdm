<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GrabCaringCt0 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // $reportmonth = Carbon::now()->format('Ym');
        // $data = DemanAddonNamaSales::where('report_month',$reportmonth)->where('peran','TAM')->cursor();
        // foreach($data as $row)
        // {
        //     $insertData = DemandAddonSale::updateOrCreate(
        //         [
        //             'ndem' => $row->ndem,
        //             'ndinet' => $row->ndinet
        //         ],
        //         [
        //             'report_month' => $row->report_month,
        //             'addon' => $row->addon,
        //             'ndem' => $row->ndem,
        //             'kcontact' => $row->kcontact,
        //             'coper' => $row->coper,
        //             'cagent' => $row->cagent,
        //             'kawasan' => $row->kawasan,
        //             'c_witel' => $row->c_witel,
        //             'c_datel_new' => $row->c_datel_new,
        //             'sto' => $row->sto,
        //             'chanel' => $row->chanel,
        //             'alpro' => $row->alpro,
        //             'tgl_va' => $row->tgl_va,
        //             'tgl_ps' => $row->tgl_ps,
        //             'cgest' => $row->cgest,
        //             'cseg' => $row->cseg,
        //             'ccat' => $row->ccat,
        //             'linecats_family_lname' => $row->linecats_family_lname,
        //             'tematik' => $row->tematik,
        //             'item' => $row->item,
        //             'cpack' => $row->cpack,
        //             'psb' => $row->psb,
        //             'cbt' => $row->cbt,
        //             'mig' => $row->mig,
        //             'price_psb' => $row->price_psb,
        //             'price_mig' => $row->price_mig,
        //             'ndinet' => $row->ndinet,
        //             'kaubis' => $row->kaubis,
        //             'kodesales' => $row->kodesales,
        //             'namasales' => $row->namasales,
        //             'peran' => $row->peran,
        //             'loker' => $row->loker,
        //             'status_follow_up_id' => 1
        //         ]
        //     );
        //     $insertData->save();
        // }
    }
}
