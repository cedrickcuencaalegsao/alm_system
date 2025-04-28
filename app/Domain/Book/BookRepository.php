<?php

namespace App\Domain\Book;

interface BookRepository
{
    public function create(Book $book);

    public function update(Book $book);

    public function findByID(int $id): ?Book;

    public function findByBookID(string $bookID): ?Book;

    public function findAll(): array;

    public function findByName(string $bookname): ?Book;

    public function findByAuthor(string $author): ?Book;

    public function updateStockWhenItemBought(string $bookID, int $quantity);

    public function search(string $searchTerm): array;

    public function getBooksInStockCount(): array;

    public function getBestSellingBook(): array;

    public function getTopSellingBook(): array;

    public function get5LowStockBooks(): array;

    public function restockBook(array $data): void;

    public function deleteBook(array $book);
}
