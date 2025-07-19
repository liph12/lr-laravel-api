<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Entities\Developer;
use App\Models\Property\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesReport extends Model
{
    protected $table = "salesreport";

    public function scopeGroupByDeveloperSales(Builder $query): Builder
    {
        return $query->selectRaw("SUM(tcprice) as totalSales, devid")
            ->developer()->groupBy("devid")->orderByDesc("totalSales");
    }

    public function scopeGroupByPropertyTypeSales(Builder $query): Builder
    {
        return $query->selectRaw("SUM(salesreport.tcprice) as totalSales, salesreport.projid, projects.prop_type_id")
        ->leftJoin('projects', 'projects.id', 'salesreport.projid')->valid()
        ->groupBy("salesreport.projid")->orderByDesc("totalSales");
    }

    public function scopeDeveloper(Builder $query): Builder
    {
        return $query->valid()->where([
            ['developer', 'NOT LIKE', '%Brokerage%'],
            ['developer', 'NOT LIKE', '%Rental%'],
            ['devid', '!=', 0]
        ]);
    }

    public function scopeValid(Builder $query): Builder
    {
        return $query->where([
            ['salesreport.validSale', 'Yes'],
            ['salesreport.status', '!=', 'Cancelled']
        ]);
    }

    public function scopeReservationDate(Builder $query, $from, $to): Builder
    {
        return $query->whereRaw("STR_TO_DATE(reservationdate, '%m/%d/%Y') >= '" . $from . "'")
            ->whereRaw("STR_TO_DATE(reservationdate, '%m/%d/%Y') <= '" . $to . "'");
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'projid');
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class, 'devid');
    }
}
