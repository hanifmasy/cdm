<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClusterUsageInet extends Model
{
    protected $connection = 'pg4';
    protected $table = 'step4_cluster_usage_inet';
}
