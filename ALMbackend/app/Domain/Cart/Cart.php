<?php

namespace App\Domain\Cart;

class Cart
{
    private ?int $id;
    private ?string $cartID;
    private ?string $userfullname;
    private ?string $bookname;
    private ?string $bookcategory;
    private ?string $author;
    private ?float $price;
    private ?string $image;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        ?int $id = null,
        ?string $cartID = null,
        ?string $userfullname = null,
        ?string $bookname = null,
        ?string $bookcategoy = null,
        ?string $author = null,
        ?float $price = null,
        ?string $image = null,
        ?string $createdAt = null,
        ?string $updatedAt = null,
    ) {
        $this->id = $id;
        $this->cartID = $cartID;
        $this->userfullname = $userfullname;
        $this->bookname = $bookname;
        $this->bookcategory = $bookcategoy;
        $this->author = $author;
        $this->price = $price;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    public function getID(): int|null
    {
        return $this->id;
    }
    public function getCartID(): string|null
    {
        return $this->cartID;
    }
    public function getUserFullName(): string|null
    {
        return $this->userfullname;
    }
    public function getBookName(): string|null
    {
        return $this->bookname;
    }
    public function getBookCategory(): string|null
    {
        return $this->bookcategory;
    }
    public function getAuthor(): string|null
    {
        return $this->author;
    }
    public function getPrice(): string|null
    {
        return $this->price;
    }
    public function getImage(): string|null
    {
        return $this->image;
    }
    public function createdAt(): string|null
    {
        return $this->createdAt;
    }
    public function updatedAt(): string|null
    {
        return $this->updatedAt;
    }
}
