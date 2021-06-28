<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformansiKaubis extends Model
{
    protected $connection = 'pg2';
    protected $table = 'performansi_addon';
    protected $fillable = [
        'report_month', 'addon', 'psb', 'witel', 'datel', 'sto', 'kaubis'
    ];
}
