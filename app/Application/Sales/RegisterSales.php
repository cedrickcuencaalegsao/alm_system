<?php

namespace App\Application\Sales;

use App\Domain\Sale\SaleRepository;

class RegisterSales
{
    private SaleRepository $salesRepository;

    public function __construct(SaleRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    public function create(array $data)
    {
        dd($data);
        // $sales = new Sales(

        // );

        // return $this->salesRepository->create($sales);
    }
}
