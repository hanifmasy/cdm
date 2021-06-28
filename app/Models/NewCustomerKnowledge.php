<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewCustomerKnowledge extends Model
{
    use SoftDeletes;

    public $table = 'edukasi_pelanggan';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'valid_from',
        'tgl_psb',
    ];

    protected $fillable = [
        'witel_str',
        'nama_pelanggan',
        'alamat',
        'notel',
        'paket_inet',
        'no_hp',
        'email',
        'status_svm',
        'valid_from',
        'nper',
        'payment_date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'tgl_psb',
        'paket_psb',
        'nohp_pcf',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
