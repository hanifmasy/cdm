<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderNormal()
    {
        return view ('admin.orderNormal.index');
    }
    public function orderAbnormal()
    {
        return view('admin.orderAbnormal.index');
    }
}
