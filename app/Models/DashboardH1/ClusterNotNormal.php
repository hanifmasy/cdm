<?php

namespace App\Models\DashboardH1;

use Illuminate\Database\Eloquent\Model;

class ClusterNotNormal extends Model
{
    protected $connection = 'pg8';
    protected $table = 'step3_notnormal_cluster_rev_h1';
}
