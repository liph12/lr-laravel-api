<?php

namespace App\Http\Services\Developer;

use App\Http\Services\Interfaces\SalesReportInterface;
use Illuminate\Database\Eloquent\Collection;

class DeveloperSalesService implements SalesReportInterface
{
    public function __construct() {}

    public function reports(array $filters): Collection
    {
        
    }
}