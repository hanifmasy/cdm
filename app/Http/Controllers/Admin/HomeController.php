<?php

namespace App\Http\Controllers\Admin;

use App\Models\DashboardH1\ClusterUsia;
use Illuminate\Support\Facades\Cache;

class HomeController
{
    public function index()
    {
        return view ('home');
    }
}
