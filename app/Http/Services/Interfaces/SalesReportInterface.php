<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SalesReportInterface{
    public function reports(array $filters): Collection;
}