<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetAddon extends Model
{
    protected $connection = 'pg2';

    protected $table = 'target_addon_v2';

    protected $fillable = [
        'report_month', 'addon', 'witel', 'datel', 'ssl', 'revenue', 'real_ssl', 'real_revenue',
    ];
}
