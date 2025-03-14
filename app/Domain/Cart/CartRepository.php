<?php

namespace App\Domain\Cart;

interface CartRepository
{
    public function create(Cart $cart);
    public function update(Cart $cart);
    public function findByID(Cart $cart): ?Cart;
    public function findByUserID(string $userID): ?Cart;
    public function findByCartID(Cart $cart): ?Cart;
    public function findAll(): array;
}
