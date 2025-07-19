<?php

namespace App\Http\Controllers\SalesTransaction\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Developer\DeveloperSalesService;
use App\Http\Services\Repositories\Factories\SalesReportServiceFactory;
use App\Http\Resources\Developer\Reports\SalesReportResourceCollection;
use App\Http\Services\Developer\ProjectSalesService;

class DeveloperReportController extends Controller
{
    public function __construct(protected SalesReportServiceFactory $factory) {}

    public function index(Request $request)
    {
        $filters = [
            'dateFrom' => date('Y-m-01'),
            'dateTo' => date('Y-m-d')
        ];

        $salesReport = $this->factory->getSalesReportByArea(new DeveloperSalesService(), $filters);

        return new SalesReportResourceCollection($salesReport);
    }

    public function propertyTypeSales()
    {
        $filters = [
            'dateFrom' => date('Y-m-01'),
            'dateTo' => date('Y-m-d')
        ];

        $salesReport = $this->factory->getSalesReportByArea(new ProjectSalesService(), $filters);
        $projectSales = $this->factory->groupProjectSalesByType($salesReport);

        return $projectSales;
    }
}
