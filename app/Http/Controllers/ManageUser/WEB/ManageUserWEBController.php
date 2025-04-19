<?php

namespace App\Http\Controllers\ManageUser\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageUserWEBController extends Controller
{
    public function index()
    {
        return view('Page.ManageUser.manageuser');
    }
}
