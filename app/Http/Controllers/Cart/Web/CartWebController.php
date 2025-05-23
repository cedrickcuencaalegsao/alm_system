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
        $carts = $this->registerCart->findByUserID($userID);

        return view('Page.Cart.cart', compact('carts'));
    }

    /**
     * Function to add item to cart
     * **/
    public function addToCart(Request $request)
    {
        $cartID = $this->generateCartID();
        $newCart = [
            'cartID' => $cartID,
            'userID' => $request->user_id,
            'bookID' => $request->book_id,
        ];

        $exists = $this->registerCart->validateNewCart($request->user_id, $request->book_id);

        if ($exists) {
            return redirect()->back()->with('error', 'Item already exists in cart');
        }

        $this->registerCart->create($newCart);

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    /**
     * Function to generate unique cart ID.
     * **/
    public function generateCartID()
    {
        do {
            $prefix = 'CRT';

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $randomPart = '';

            for ($i = 0; $i < 12; $i++) {
                $randomPart .= $characters[rand(0, strlen($characters) - 1)];
            }

            $cartID = $prefix.$randomPart;

            $exists = $this->registerCart->findByCartID($cartID);
        } while ($exists !== null);

        return $cartID;
    }

    /**
     * Function to soft delete cart.
     * **/
    public function softDelete(string $cartID)
    {
        $this->registerCart->softDelete($cartID);

        return redirect()->back()->with('success', 'Item removed from cart successfully');
    }
}
