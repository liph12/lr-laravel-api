<?php

namespace App\Models\RoleEntities;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\SalesReport;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    public function sales(): HasMany
    {
        return $this->hasMany(SalesReport::class, 'agentid', 'memberid');
    }
}
