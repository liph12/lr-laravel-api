<?php

namespace App\Http\Resources\Developer\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->devid,
            'name' => $this->developer->name,
            'totalSales' => $this->totalSales,
        ];
    }
}
