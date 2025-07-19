<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\SalesReport;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Developer extends Model
{
    public function sales(): HasMany
    {
        return $this->hasMany(SalesReport::class, 'devid');
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('approved', 1);
    }
}
