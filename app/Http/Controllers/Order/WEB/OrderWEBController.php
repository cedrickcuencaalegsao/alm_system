<?php

namespace App\Http\Controllers\Order\WEB;

use App\Application\Book\RegisterBook;
use App\Application\Cart\RegisterCart;
use App\Application\Sales\RegisterSales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderWEBController extends Controller
{
    private RegisterSales $registerSales;

    private RegisterBook $registerBook;

    private RegisterCart $registerCart;

    public function __construct(RegisterSales $registerSales, RegisterBook $registerBook, RegisterCart $registerCart)
    {
        $this->registerSales = $registerSales;
        $this->registerBook = $registerBook;
        $this->registerCart = $registerCart;
    }

    /**
     * Function to create sales on the cart page (multiple items).
     * **/
    public function checkoutMultipleItems(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'selected_items' => 'required|array',
            'selected_items.*' => 'required|string',
            'quantity' => 'required|array',
            'book_id' => 'required|array',
            'shipping_cost' => 'required|numeric',
            'order_total' => 'required|numeric',
        ]);

        // Process each selected item
        $salesData = [];
        $totalTax = 0;
        $totalSales = 0;
        $refID = $this->generateRefID();

        foreach ($request->selected_items as $cartID) {
            $bookID = $request->book_id[$cartID];
            $quantity = intval($request->quantity[$cartID]);
            $bookPrice = $this->getBookPrice($bookID);

            $tax = $bookPrice * 0.12 * $quantity;
            $sales = $bookPrice * $quantity;

            $totalTax += $tax;
            $totalSales += $sales;

            $salesID = $this->generateSalesID();

            $salesData[] = [
                'salesID' => $salesID,
                'bookID' => $bookID,
                'userID' => $request->user_id,
                'refID' => $refID,
                'quantity' => $quantity,
                'status' => 'pending',
                'tax' => $tax,
                'totalsales' => $sales + $tax,
            ];

            $this->registerCart->softDelete($cartID);
        }
        // Create sales records for all items
        foreach ($salesData as $data) {
            $this->updateStockWhenItemBought($data['bookID'], $data['quantity']);
            $this->registerSales->createSales($data);
        }

        return redirect('/home')->with('success', 'Order created successfully');
    }

    /**
     * Function to create sales on the buy now button.
     * **/
    public function checkoutItemDrectly(Request $request)
    {
        $bookPrice = $this->getBookPrice($request->book_id);
        $tax = $bookPrice * 0.12;
        $sales = $bookPrice * intval($request->quantity);
        $totalsales = $sales + $tax;
        $salesID = $this->generateSalesID();
        $refID = $this->generateRefID();

        $data = [
            'salesID' => $salesID,
            'bookID' => $request->book_id,
            'userID' => $request->user_id,
            'refID' => $refID,
            'quantity' => intval($request->quantity),
            'status' => 'pending',
            'tax' => $tax,
            'totalsales' => $totalsales,
        ];

        $this->registerCart->softDelete($request->cart_id);
        $this->registerSales->createSales($data);
        $this->updateStockWhenItemBought($request->book_id, $request->quantity);

        return redirect('/home')->with('success', 'Order created successfully');
    }

    /**
     * Function to update stock when item is bought.
     * **/
    public function updateStockWhenItemBought(string $bookID, int $quantity): void
    {
        $this->registerBook->updateStockWhenItemBought($bookID, $quantity);
    }

    /**
     * Function to get book price.
     * **/
    public function getBookPrice(string $bookID)
    {
        $book = $this->registerBook->findByBookID($bookID);

        return $book->getPrice();
    }

    /**
     * Function to generate unique sales ID.
     * **/
    public function generateSalesID()
    {
        do {
            $prefix = 'SLS';

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $randomPart = '';

            for ($i = 0; $i < 12; $i++) {
                $randomPart .= $characters[rand(0, strlen($characters) - 1)];
            }

            $salesID = $prefix.$randomPart;

            $exists = $this->registerSales->findBySalesID($salesID);
        } while ($exists !== null);

        return $salesID;
    }

    /**
     * Function to generate unique ref ID.
     * **/
    public function generateRefID()
    {
        do {
            $prefix = 'REF';

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $randomPart = '';

            for ($i = 0; $i < 12; $i++) {
                $randomPart .= $characters[rand(0, strlen($characters) - 1)];
            }

            $refID = $prefix.$randomPart;

            $exists = $this->registerSales->findByRefID($refID);
        } while ($exists !== null);

        return $refID;
    }

    /**
     * Function to view checkout page.
     * **/
    public function viewCheckout(string $bookID)
    {
        $book = $this->registerBook->findByBookID($bookID);

        return view('Page.Checkout.checkout', compact('book'));
    }

    /**
     * Function to view order page.
     * **/
    public function index(string $userID)
    {
        $userID = decrypt($userID);
        $sales = $this->registerSales->findAllUserOrders($userID);

        return view('Page.Order.order', compact('sales'));
    }
}
