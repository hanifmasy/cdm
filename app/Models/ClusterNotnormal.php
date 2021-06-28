<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClusterNotnormal extends Model
{
    protected $connection = 'pg4';
    protected $table = 'step3_notnormal_cluster_rev';
}
