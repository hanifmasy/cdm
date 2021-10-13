<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PSBAllSegmen extends Model
{
    protected $connection = 'pg20';
    protected $table = 'channel_psb_distinct_fixed';
}
