<?php

namespace App\Exports;

use App\Models\NewCustomerKnowledge;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EdukasiPelangganExport implements FromCollection, WithHeadings
{
    protected $value;
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($value)
    {
        $this->value = $value;
    }

    public function collection()
    {
        //
        $data = $this->value;
        $collection = new Collection();
        $query = NewCustomerKnowledge::select('id','nper','witel_str','nama_pelanggan','alamat','notel','paket_inet','no_hp','email','status_svm','payment_date','tgl_psb','paket_psb','nohp_pcf');
        if(isset($data['nper']))
        {
            $query->where('nper',$data['nper']);
        }
        if(isset($data['jumlah']))
        {
            $query->take($data['jumlah']);
        }
        $value = $query->where('status',0)->get();
        foreach($value as $row)
        {
            $collection->push((object)
            [
                'nper' => $row->nper,
                'witel' => $row->witel_str,
                'nama_pelanggan' => $row->nama_pelanggan,
                'alamat' => $row->alamat,
                'notel' => $row->notel,
                'paket_inet' => $row->paket_inet,
                'no_hp' => $row->no_hp,
                'email' => $row->email,
                'status_svm' => $row->status_svm,
                'payment_date' => $row->payment_date,
                'tgl_psb' => $row->tgl_psb,
                'paket_psb' => $row->paket_psb,
                'nohp_pcf' => $row->nohp_pcf,
            ]);
            NewCustomerKnowledge::where('id',$row->id)->update(['status' => 1]);
        }
        return $collection;
    }

    public function headings(): array
        {
            return [
                'NPER',
                'WITEL',
                'NAMA PELANGGAN',
                'ALAMAT',
                'NO TELEPON',
                'PAKET INET',
                'NOMOR HP',
                'EMAIL',
                'STATUS SVM',
                'PAYMENT DATE',
            ];
        }
}
