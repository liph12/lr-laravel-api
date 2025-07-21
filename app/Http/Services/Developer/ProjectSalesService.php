<?php

namespace App\Http\Services\Developer;

use App\Http\Services\Repositories\Interfaces\SalesReportInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Transactions\SalesReport;

class ProjectSalesService implements SalesReportInterface
{
    public function __construct()
    {
        // to do
    }

    public function reportsByArea(array $filters): Collection
    {
        return SalesReport::reservationDate($filters['dateFrom'], $filters['dateTo'])
            ->with('project.type')->whereHas('project')->groupByPropertyTypeSales()->limit(10)->get();
    }
}
