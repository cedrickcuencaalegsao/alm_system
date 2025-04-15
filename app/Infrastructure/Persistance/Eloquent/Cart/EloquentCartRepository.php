<?php

namespace App\Infrastructure\Persistance\Eloquent\Cart;

use App\Domain\Cart\Cart;
use App\Domain\Cart\CartRepository;

class EloquentCartRepository implements CartRepository
{
    /**
     * Function to create new cart.
     * **/
    public function create(Cart $cart): void
    {
        $newCart = new CartModel;
        $newCart->cartID = $cart->getCartID();
        $newCart->userID = $cart->getUserID();
        $newCart->bookname = $cart->getBookName();
        $newCart->bookcategory = $cart->getBookCategory();
        $newCart->author = $cart->getAuthor();
        $newCart->price = $cart->getPrice();
        $newCart->image = $cart->getImage();
        $newCart->createdAt = $cart->createdAt();
        $newCart->updatedAt = $cart->updatedAt();
        $newCart->save();
    }

    /**
     * Function to update cart data.
     * **/
    public function update(Cart $cart): void
    {
        $newCartData = CartModel::find($cart->getID()) ?? new CartModel;
        $newCartData->cartID = $cart->getCartID();
        $newCartData->userID = $cart->getUserID();
        $newCartData->bookname = $cart->getBookName();
        $newCartData->bookcategory = $cart->getBookCategory();
        $newCartData->author = $cart->getAuthor();
        $newCartData->price = $cart->getPrice();
        $newCartData->image = $cart->getImage();
        $newCartData->createdAt = $cart->createdAt();
        $newCartData->updatedAt = $cart->updatedAt();
        $newCartData->save();
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
    public function findByUserID(string $userID): array
    {
        $userID = decrypt($userID);

        $cart = CartModel::where('userID', $userID)->get();
        if (! $cart) {
            return [];
        }

        return CartModel::where('userID', $userID)->get()->map(fn ($cart) => new Cart(
            $cart->id,
            $cart->cartID,
            $cart->userID,
            $cart->book->bookname,
            $cart->book->bookcategory,
            $cart->book->author,
            $cart->book->bookprice,
            $cart->book->image,
            $cart->createdAt,
            $cart->updatedAt,
        ))->toArray();
    }

    /**
     * Function to find cart by cartID.
     * **/
    public function findByCartID(Cart $cart): ?Cart
    {
        $cart = CartModel::where('cardID', $cart->getCartID())->first();

        return new Cart(
            $cart->id,
            $cart->cartID,
            $cart->userID,
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