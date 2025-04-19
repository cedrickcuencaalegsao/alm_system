<?php

namespace App\Http\Controllers\ManageOrders\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageOrdersWEBController extends Controller
{
    public function index()
    {
        return view('Page.ManageOrder.manageorder');
    }
}
