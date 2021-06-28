<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketNormal()
    {
        return view ('admin.ticketNormal.index');
    }
    public function ticketAbnormal()
    {
        return view('admin.ticketAbnormal.index');
    }
}
