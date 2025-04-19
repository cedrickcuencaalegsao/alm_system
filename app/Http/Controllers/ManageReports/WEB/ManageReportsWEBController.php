<?php

namespace App\Http\Controllers\ManageReports\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageReportsWEBController extends Controller
{
    public function index()
    {
        return view('Page.ManageReports.managereports');
    }
}
