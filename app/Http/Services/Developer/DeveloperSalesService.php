<?php

namespace App\Http\Services\Developer;

use App\Http\Services\Repositories\Interfaces\SalesReportInterface;
use App\Models\Transactions\SalesReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeveloperSalesService implements SalesReportInterface
{
    public function __construct() {}

    public function reportsByArea(array $filters): Collection
    {
        return SalesReport::reservationDate($filters['dateFrom'], $filters['dateTo'])
            ->with(['developer' => function (BelongsTo $query) {
                $query->approved();
            }])->groupByDeveloperSales()->limit(10)->get();
    }
}
