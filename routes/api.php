<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesTransaction\Developer\DeveloperReportController;

Route::apiResource('developers', DeveloperReportController::class);

Route::get('/sales-by-property-type', [DeveloperReportController::class, 'propertyTypeSales']);