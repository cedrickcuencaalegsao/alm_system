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
}
