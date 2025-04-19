<?php

namespace App\Http\Controllers\Dashboard\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWEBController extends Controller
{
    public function index()
    {
        return view('Page.Dashboard.dashboard');
    }
}
