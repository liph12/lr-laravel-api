<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesTransaction\Developer\DeveloperReportController;

Route::apiResource('developers', DeveloperReportController::class);
