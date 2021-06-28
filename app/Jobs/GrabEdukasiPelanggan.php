<?php

namespace App\Jobs;

use App\Models\EdukasiPelanggan;
use App\Models\NewCustomerKnowledge;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GrabEdukasiPelanggan implements ShouldQueue
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
        $date = date('Y-m-d H:i:s', strtotime('-3 months'));
        $data = EdukasiPelanggan::where('tgl_psb',$date)->cursor();
        foreach($data as $row)
        {
            $insertData = NewCustomerKnowledge::updateOrCreate(
                [
                    'nper' => $row->nper,
                    'notel' => $row->notel
                ],
                [
                    'witel_str' => $row->witel_str,
                    'nama_pelanggan' => $row->nama_pelanggan,
                    'alamat' => $row->alamat,
                    'notel' => $row->notel,
                    'paket_inet' => $row->paket_inet,
                    'no_hp' => $row->no_hp,
                    'email' => $row->email,
                    'status_svm' => $row->status_svm,
                    'valid_from' => $row->valid_from,
                    'nper' => $row->nper,
                    'tgl_psb' => $row->tgl_psb,
                    'paket_psb' => $row->paket_psb,
                    'nohp_pcf' => $row->nohp_pcf,
                    'payment_date' => $row->payment_date,
                ]
            );
            $insertData->save();
        }
    }
}
