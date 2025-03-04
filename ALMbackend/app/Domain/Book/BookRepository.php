<?php

namespace App\Domain\Book;

interface BookRepository
{
    public function create(Book $book);
    public function update(Book $book);
    public function findAll(): array;
    public function findByName(string $searchTerm): ?Book;
    public function findByAuthor(string $searchTerm): ?Book;
}
