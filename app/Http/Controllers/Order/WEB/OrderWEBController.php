<?php

namespace App\Http\Controllers\Order\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderWEBController extends Controller
{
    public function index(){
        return view('Page.Order.order');
    }
}
