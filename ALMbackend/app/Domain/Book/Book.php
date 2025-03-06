<?php

namespace App\Domain\Book;

class Book
{
    private ?int $id;
    private ?string $bookID;
    private ?string $bookname;
    private ?string $bookdetails;
    private ?string $author;
    private ?int $stock;
    private ?string $category;
    private ?string $datepublish;
    private ?string $image;
    private ?float $price;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        ?int $id = null,
        ?string $bookID = null,
        ?string $bookname = null,
        ?string $bookdetails = null,
        ?string $author = null,
        ?int $stock = null,
        ?string $category = null,
        ?string $datepublish = null,
        ?string $image = null,
        ?float $price = null,
        ?string $createdAt = null,
        ?string $updatedAt = null,
    ) {
        $this->id = $id;
        $this->bookID = $bookID;
        $this->bookname = $bookname;
        $this->bookdetails = $bookdetails;
        $this->author = $author;
        $this->stock = $stock;
        $this->category = $category;
        $this->datepublish = $datepublish;
        $this->image = $image;
        $this->price = $price;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'bookID' => $this->bookID,
            'bookname' => $this->bookname,
            'bookdetails' => $this->bookdetails,
            'author' => $this->author,
            'stock' => $this->stock,
            'category' => $this->category,
            'datepublish' => $this->datepublish,
            'image' => $this->image,
            'price' => $this->price,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
    public function getId(): int|null
    {
        return $this->id;
    }
    public function getBookID(): string|null
    {
        return $this->bookID;
    }
    public function getBookName(): string|null
    {
        return $this->bookname;
    }
    public function getBookDetails(): string|null
    {
        return $this->bookdetails;
    }
    public function getAuthor(): string|null
    {
        return $this->author;
    }
    public function getStock(): int|null
    {
        return $this->stock;
    }
    public function getCategory(): string|null
    {
        return $this->category;
    }
    public function getDatePublish()
    {
        return $this->datepublish;
    }
    public function getImage(): string|null
    {
        return $this->image;
    }
    public function getPrice(): float|null
    {
        return $this->price;
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
