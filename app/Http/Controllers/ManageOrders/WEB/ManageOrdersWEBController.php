<?php

namespace App\Http\Controllers\ManageOrders\WEB;

use App\Application\Sales\RegisterSales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageOrdersWEBController extends Controller
{
    private $registerSales;

    public function __construct(RegisterSales $registerSales)
    {
        $this->registerSales = $registerSales;
    }

    public function index(Request $request)
    {
        $data = [
            'totalSales' => $this->registerSales->countAll(),
            'pending' => $this->registerSales->countPending(),
            'processing' => $this->registerSales->countProcessing(),
            'delivering' => $this->registerSales->countDelivering(),
            'completed' => $this->registerSales->countCompleted(),
        ];

        $search = $request->input('search');

        if ($search) {
            $sales = $this->registerSales->searchSales($search, 5);
        } else {
            $sales = $this->registerSales->findAllPaginated(5);
        }

        return view('Page.ManageOrder.manageorder', compact('data', 'sales', 'search'));
    }

    public function updateStatus(Request $request)
    {
        $saleID = $request->input('saleID');
        $status = $request->input('status');

        $this->registerSales->updateStatus($saleID, $status);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
