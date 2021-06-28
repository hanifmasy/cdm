<?php

namespace App\Models\DashboardH1;

use Illuminate\Database\Eloquent\Model;

class ClusterNormal extends Model
{
    protected $connection = 'pg8';
    protected $table = 'step3_normal_cluster_rev_h1';
}
