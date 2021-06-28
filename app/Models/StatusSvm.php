<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusSvm extends Model
{
    //
    protected $connection = 'pg17';
    protected $table = 'qc_netezza_fixed';
}
