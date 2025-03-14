<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebAuthController extends Controller
{
    public function viewLogin(): View
    {
        return view('Page.Auth.Auth');
    }
    public function viewRegister(): View
    {
        return view('Page.Auth.Register');
    }
}
