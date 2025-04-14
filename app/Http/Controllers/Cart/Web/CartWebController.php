<?php

namespace App\Http\Controllers\Cart\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartWebController extends Controller
{
    public function index(Request $request)
    {
        // Logic to display the cart
        return view('Page.Cart.cart');
    }
}
