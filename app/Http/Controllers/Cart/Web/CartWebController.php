<?php

namespace App\Http\Controllers\Cart\Web;

use App\Application\Cart\RegisterCart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartWebController extends Controller
{
    private RegisterCart $registerCart;

    public function __construct(RegisterCart $registerCart)
    {
        $this->registerCart = $registerCart;
    }

    /**
     * Function to get the cart data by userID.
     * **/
    public function index(Request $request, string $userID)
    {
        // dd($userID);
        $carts = $this->registerCart->findByUserID($userID);

        return view('Page.Cart.cart', compact('carts'));
    }
}
