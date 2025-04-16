<?php

namespace App\Application\Cart;

use App\Domain\Cart\Cart;
use App\Domain\Cart\CartRepository;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class RegisterCart
{
    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function create(array $data)
    {

        $newCart = new Cart(
            null,
            $data['cartID'],
            $data['userID'],
            $data['bookID'],
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString(),
        );

        return $this->cartRepository->create($newCart);
    }

    public function update() {}

    public function findByID() {}

    public function findByUserID(string $userID)
    {
        return $this->cartRepository->findByUserID($userID);
    }

    public function findByCartID(string $cartID) {
        return $this->cartRepository->findByCartID($cartID);
    }

    public function findAll()
    {
        return $this->cartRepository->findAll();
    }

    public function softDelete(string $cartID)
    {
        return $this->cartRepository->softDelete($cartID);
    }
}
