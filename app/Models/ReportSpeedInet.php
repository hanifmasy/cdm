<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportSpeedInet extends Model
{
    protected $connection = 'pg7';
    protected $table = 'reporting_speed_inet_fixed';
}
