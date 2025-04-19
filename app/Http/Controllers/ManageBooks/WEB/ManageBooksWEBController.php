<?php

namespace App\Http\Controllers\ManageBooks\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageBooksWEBController extends Controller
{
    public function index()
    {
        return view('Page.ManageBooks.managebooks');
    }
}
