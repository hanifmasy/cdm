<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardKaubis extends Model
{
    protected $connection = 'pg2';
    protected $table = 'performansi_addon';
    protected $fillable = [
        'report_month', 'addon', 'ndem', 'kcontact', 'coper', 'cagent', 'kawasan', 'witel',
        'datel', 'sto', 'channel', 'alpro', 'tgl_va', 'tgl_ps', 'cgest', 'cseg', 'ccat', 
        'linecats_family_lname', 'tematik', 'item', 'cpack', 'psb', 'cbt', 'mig', 'price_psb',
        'price_cbt', 'price_mig', 'ndinet', 'kaubis', 'nik'
    ];
}
