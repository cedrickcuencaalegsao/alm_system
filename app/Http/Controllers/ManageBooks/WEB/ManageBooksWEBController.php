<?php

namespace App\Http\Controllers\ManageBooks\WEB;

use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageBooksWEBController extends Controller
{
    protected $registerBook;

    public function __construct(RegisterBook $registerBook)
    {
        $this->registerBook = $registerBook;
    }

    public function createNewBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bookname' => 'required',
            'author' => 'required',
            'bookcategory' => 'required',
            'datepublish' => 'required',
            'stocks' => 'required',
            'bookprice' => 'required',
            'bookdetails' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal', true);
        }

        $data = $request->all();
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = 'assets/images/books';
            $imageName = date('YmdHis').'.'.$image->getClientOriginalExtension();

            $image->move(public_path($destinationPath), $imageName);
            $data['image'] = $imageName;
            $this->create($data);

        } else {
            $this->create($data);
        }

        return redirect()->route('view.new.book')->with('success', 'Book has been successfully added!');
    }

    public function create($data)
    {
        $data['bookID'] = $this->generateBookID();
        $this->registerBook->create($data);
    }

    public function generateBookID()
    {
        do {
            $prefix = 'BK';

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $randomPart = '';

            for ($i = 0; $i < 12; $i++) {
                $randomPart .= $characters[rand(0, strlen($characters) - 1)];
            }

            $bookId = $prefix.$randomPart;

            $exists = $this->registerBook->findByBookID(encrypt($bookId));
        } while ($exists !== null);

        return $bookId;
    }

    public function restockBook(Request $request)
    {
        $this->registerBook->restockBook($request->bookID, $request->quantity);

        return redirect()->back()->with('success', 'Book has been successfully restocked!');
    }

    public function restockIndex(string $bookID)
    {
        $book = $this->registerBook->findByBookID(decrypt($bookID));

        return view('Page.Restock.restock', compact('book'));
    }

    public function newBookIndex()
    {
        return view('Page.NewBook.newbook');
    }

    public function index(Request $request)
    {
        $search = $request->input('query');
        if ($search) {
            $books['allBooks'] = $this->registerBook->search($search);
            return view('Page.ManageBooks.managebooks', compact('books', 'search'));
        } else {
            $books = $this->registerBook->findAll();

            return view('Page.ManageBooks.managebooks', compact('books', 'search'));
        }
    }

    public function editBook(string $bookID)
    {
        $book = $this->registerBook->findByBookID(decrypt($bookID));

        return view('Page.AdminEditBook.admineditbook', compact('book'));
    }
}
