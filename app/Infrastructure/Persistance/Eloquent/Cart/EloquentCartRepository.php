<?php

namespace App\Infrastructure\Persistance\Eloquent\Cart;

use App\Domain\Cart\Cart;
use App\Domain\Cart\CartRepository;

class EloquentCartRepository implements CartRepository
{
    /**
     * Function to create new cart.
     * **/
    public function create(Cart $cart)
    {
        $newCart = new CartModel;
        $newCart->cartID = $cart->getCartID();
        $newCart->userID = $cart->getUserID();
        $newCart->bookID = $cart->getBookID();
        $newCart->isDeleted = false;
        $newCart->createdAt = $cart->createdAt();
        $newCart->updatedAt = $cart->updatedAt();
        $newCart->save();
    }

    /**
     * Function to update cart data.
     * **/
    public function update(Cart $cart)
    {
        $newCart = new CartModel;
        $newCart->cartID = $cart->getCartID();
        $newCart->userID = $cart->getUserID();
        $newCart->bookID = $cart->getBookID();
        $newCart->isDeleted = $cart->getIsDeleted();
        $newCart->createdAt = $cart->createdAt();
        $newCart->updatedAt = $cart->updatedAt();
        $newCart->save();
    }

    /**
     * Function to find cart by id.
     * **/
    public function findByID(Cart $cart): ?Cart
    {
        $cart = CartModel::find($cart->getID());

        return new Cart(
            $cart->id,
            $cart->cartID,
            $cart->userID,
            $cart->bookID,
            $cart->isDeleted,
            $cart->bookname,
            $cart->bookcategory,
            $cart->author,
            $cart->price,
            $cart->image,
            $cart->createdAt,
            $cart->updatedAt,
        );
    }

    /**
     * Function to get cart data by userID.
     * **/
    public function findByUserID(string $userID): ?array
    {
        $userID = decrypt($userID);

        $cart = CartModel::where('userID', $userID)->where('isDeleted', false)->get();
        if (! $cart) {
            return null;
        }

        return CartModel::where('userID', $userID)->where('isDeleted', false)->get()->map(fn ($cart) => new Cart(
            $cart->id,
            $cart->cartID,
            $cart->userID,
            $cart->bookID,
            $cart->isDeleted,
            $cart->createdAt,
            $cart->updatedAt,
            $cart->book->bookname,
            $cart->book->bookcategory,
            $cart->book->author,
            $cart->book->bookprice,
            $cart->book->image,
        ))->toArray();
    }

    /**
     * Function to find cart by cartID.
     * **/
    public function findByCartID(string $cartID): ?Cart
    {
        $cart = CartModel::where('cartID', $cartID)->first();
        if (! $cart) {
            return null;
        }

        return new Cart(
            $cart->id,
            $cart->cartID,
            $cart->userID,
            $cart->bookID,
            $cart->isDeleted,
            $cart->createdAt,
            $cart->updatedAt,
        );
    }
    /**
     * Function to soft delete cart.
     * **/
    public function softDelete(string $cartID)
    {
        $cart = CartModel::where('cartID', $cartID)->first();
        $cart->isDeleted = true;
        $cart->save();
    }
    /**
     * Function to get all cart data.
     * **/
    public function findAll(): array
    {

        return CartModel::all()->map(fn ($cart) => new Cart(
            id: $cart->id,
            cartID: $cart->cartID,
            userID: $cart->userID,
            bookname: $cart->bookname,
            bookcategoy: $cart->bookcategory,
            author: $cart->author,
            price: $cart->price,
            image: $cart->image,
            createdAt: $cart->createdAt,
            updatedAt: $cart->updatedAt,
        ))->toArray();
    }
}
