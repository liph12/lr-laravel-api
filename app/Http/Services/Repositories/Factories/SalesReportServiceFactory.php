<?php

namespace App\Http\Services\Repositories\Factories;

use App\Http\Services\Repositories\Interfaces\SalesReportInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\Developer\Reports\ProjectSalesReportResourceCollection;

class SalesReportServiceFactory
{
   public function getSalesReportByArea(SalesReportInterface $SRService, array $filters): Collection
   {
      return $SRService->reportsByArea($filters);
   }

   public function groupProjectSalesByType(Collection $sales): array
   {
      $jsonResource = new ProjectSalesReportResourceCollection($sales);
      $salesResource = $jsonResource->resolve();
      $grouped = [];
      $rank = 0;
      
      foreach ($salesResource as $sale) {
         $type = $sale['type'];
         $typeId = $type['id'];
         $rank ++;
     
         if (!isset($grouped[$typeId])) {
             $grouped[$typeId] = [
                 'id' => $rank,
                 'typeId' => $typeId,
                 'type' => $type['catname'],
                 'totalSales' => 0
             ];
         }
     
         $grouped[$typeId]['totalSales'] += $sale['totalSales'];
     }
     
     $results = array_values($grouped);
     usort($results, fn($a, $b) => $b['totalSales'] <=> $a['totalSales']);

     return $results;
   }
}
