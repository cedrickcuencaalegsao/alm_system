<?php

namespace App\Http\Controllers\Home\Web;

use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;

class HomeWebController extends Controller
{
    private RegisterBook $registerBook;

    public function __construct(RegisterBook $registerBook)
    {
        $this->registerBook = $registerBook;
    }

    public function index()
    {
        $books = collect($this->registerBook->findAll());
        // dd($books);

        return view('Page.home.home', compact('books'));
    }

    private function getCategories($books)
    {
        return $books->groupBy(function ($book) {
            return $book->getCategory();
        })->map(function ($group) {
            return $group->count();
        })->toArray();
    }
}
