<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Entities\Developer;

class SalesReport extends Model
{
    protected $table = "salesreport";

    public function scopeGroupByDeveloperSales($q)
    {
        return $q->selectRaw("SUM(tcprice) as totalSales, devid")
            ->developer()->groupBy("devid")->orderByDesc("totalSales");
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
            ['validSale', 'Yes'],
            ['status', '!=', 'Cancelled']
        ]);
    }

    public function scopeReservationDate(Builder $query, $from, $to): Builder
    {
        return $query->whereRaw("STR_TO_DATE(reservationdate, '%m/%d/%Y') >= '" . $from . "'")
            ->whereRaw("STR_TO_DATE(reservationdate, '%m/%d/%Y') <= '" . $to . "'");
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'devid');
    }
}
