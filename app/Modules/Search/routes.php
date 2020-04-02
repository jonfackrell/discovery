<?php

use App\Modules\Search\Http\Controllers\ItemController;
use App\Modules\Search\Http\Controllers\SearchController;

Route::get('/search', SearchController::class)->name('search');
Route::get('/item/{item}', ItemController::class)->name('item.view');
