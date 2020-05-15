<?php

use App\Modules\Stackmaps\Http\Controllers\MapSearchController;
use App\Modules\Stackmaps\Http\Controllers\MapItemDisplayController;

Route::get('/mapsearch', MapSearchController::class);
Route::get('/map/{collection}/{call}', MapItemDisplayController::class)->name('map.item');
