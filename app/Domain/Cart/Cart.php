<?php

namespace App\Domain\Cart;

class Cart
{
    private ?int $id;

    private ?string $cartID;

    private ?string $userID;

    private ?string $bookID;

    private ?bool $isDeleted;

    private ?string $createdAt;

    private ?string $updatedAt;

    public ?string $bookname;

    public ?string $bookcategory;

    public ?string $author;

    public ?string $price;

    public ?string $image;

    public ?int $stocks;

    public function __construct(
        ?int $id = null,
        ?string $cartID = null,
        ?string $userID = null,
        ?string $bookID = null,
        ?bool $isDeleted = null,
        ?string $createdAt = null,
        ?string $updatedAt = null,
        ?string $bookname = null,
        ?string $bookcategory = null,
        ?string $author = null,
        ?string $price = null,
        ?string $image = null,
        ?int $stocks = null
    ) {
        $this->id = $id;
        $this->cartID = $cartID;
        $this->userID = $userID;
        $this->bookID = $bookID;
        $this->isDeleted = $isDeleted;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->bookname = $bookname;
        $this->bookcategory = $bookcategory;
        $this->author = $author;
        $this->price = $price;
        $this->image = $image;
        $this->stocks = $stocks;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getCartID(): ?string
    {
        return $this->cartID;
    }

    public function getUserID(): ?string
    {
        return $this->userID;
    }

    public function getBookID(): ?string
    {
        return $this->bookID;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getBookName(): ?string
    {
        return $this->bookname;
    }

    public function getBookCategory(): ?string
    {
        return $this->bookcategory;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function getStocks(): ?int
    {
        return $this->stocks;
    }

}
