<?php

namespace App\Http\Services\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SalesReportInterface
{
    public function reportsByArea(array $filters): Collection;
}
