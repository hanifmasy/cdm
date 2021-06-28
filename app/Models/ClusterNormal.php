<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClusterNormal extends Model
{
    protected $connection = 'pg4';
    protected $table = 'step3_normal_cluster_rev';
}
