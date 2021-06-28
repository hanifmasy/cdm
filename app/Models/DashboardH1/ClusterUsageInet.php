<?php

namespace App\Models\DashboardH1;

use Illuminate\Database\Eloquent\Model;

class ClusterUsageInet extends Model
{
    protected $connection = 'pg8';
    protected $table = 'step4_cluster_usage_inet_h1';
}
