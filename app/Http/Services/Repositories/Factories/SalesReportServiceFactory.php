<?php

namespace App\Http\Services\Repositories\Factories;

use App\Http\Services\Repositories\Interfaces\SalesReportInterface;
use Illuminate\Database\Eloquent\Collection;

class SalesReportServiceFactory
{
   public function getSalesReportByArea(SalesReportInterface $SRService, array $filters): Collection
   {
      return $SRService->reportsByArea($filters);
   }
}
