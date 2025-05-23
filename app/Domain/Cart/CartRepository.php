<?php

namespace App\Domain\Cart;

interface CartRepository
{
    public function create(Cart $cart);

    public function update(Cart $cart);

    public function findByID(Cart $cart): ?Cart;

    public function findByUserID(string $userID): ?array;

    public function softDelete(string $cartID);

    public function findByCartID(string $cartID): ?Cart;

    public function findAll(): array;

    public function validateNewCart(string $userID, string $bookID): bool;
}
