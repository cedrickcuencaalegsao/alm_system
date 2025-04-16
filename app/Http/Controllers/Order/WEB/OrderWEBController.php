<?php

namespace App\Http\Controllers\Order\WEB;

use App\Application\Sales\RegisterSales;
use App\Domain\Book\BookRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderWEBController extends Controller
{
    private RegisterSales $registerSales;

    public function __construct(RegisterSales $registerSales, BookRepository $bookRepository)
    {
        $this->registerSales = $registerSales;
        $this->bookRepository = $bookRepository;
    }

    public function checkoutItemDrectly(Request $request)
    {
        dd($request->all());
        // $this->registerSales->create($request->all());

        // return redirect()->back()->with('success', 'Order created successfully');
    }

    public function viewCheckout(string $bookID)
    {
        $book = $this->bookRepository->findByBookID($bookID);

        return view('Page.Checkout.checkout', compact('book'));
    }

    public function index()
    {
        return view('Page.Order.order');
    }
}
