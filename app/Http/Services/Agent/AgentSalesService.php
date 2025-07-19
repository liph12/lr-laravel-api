<?php

namespace App\Http\Services\Agent;

use App\Http\Services\Repositories\Interfaces\SalesReportInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\RoleEntities\Member as Agent;

class AgentSalesService implements SalesReportInterface
{
   public function __construct() {}

   public function reportsByArea(array $filters): Collection
   {
      return Agent::with('sales')->get();
   }
}
