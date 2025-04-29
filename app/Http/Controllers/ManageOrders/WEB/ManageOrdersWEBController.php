<?php

namespace App\Http\Controllers\ManageOrders\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Application\Sales\RegisterSales;

class ManageOrdersWEBController extends Controller
{
    private $registerSales;
    public function __construct(RegisterSales $registerSales){
        $this->registerSales = $registerSales;
    }
    public function index()
    {
        $data = [
            'totalSales' => $this->registerSales->countAll(),
            'pending' => $this->registerSales->countPending(),
            'processing' => $this->registerSales->countProcessing(),
            'delivering'=> $this->registerSales->countDelivering(),
            'completed' => $this->registerSales->countCompleted(),
            'sales'=> $this->registerSales->findAllPaginated(5),
        ];
        return view('Page.ManageOrder.manageorder', compact('data'));
    }
}
