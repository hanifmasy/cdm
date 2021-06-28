<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MigNonIndibox extends Model
{
    //
    protected $connection = 'pg2';
    protected $table = 'ditcons_mig_2p3p_non_indibox_fixed';
}
