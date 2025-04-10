<?php
namespace App\Application\Cart;

use App\Domain\Cart\Cart;
use App\Domain\Cart\CartRepository;

class RegisterCart{
    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function create(Cart $cart){}
    public function update(){}
    public function findByID(){}
    public function findByUserID(){}
    public function findByCartID(){}
    public function findAll(){}
}
