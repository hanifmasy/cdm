<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScAddonStatus extends Model
{
    protected $connection = 'pg15';
    protected $table = 'SC_ADDON_STATUS';
    // protected $fillable = [
    //     'report_month', 'addon', 'ndem', 'kcontact', 'coper', 'cagent', 'kawasan', 'witel',
    //     'datel', 'sto', 'channel', 'alpro', 'tgl_va', 'tgl_ps', 'cgest', 'cseg', 'ccat', 
    //     'linecats_family_lname', 'tematik', 'item', 'cpack', 'psb', 'cbt', 'mig', 'price_psb',
    //     'price_cbt', 'price_mig', 'ndinet', 'kaubis', 'nik'
    // ];
}
