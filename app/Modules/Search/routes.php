<?php

use App\Modules\Search\Http\Controllers\ExportController;
use App\Modules\Search\Http\Controllers\FolderController;
use App\Modules\Search\Http\Controllers\FulltextController;
use App\Modules\Search\Http\Controllers\ItemController;
use App\Modules\Search\Http\Controllers\LikeController;
use App\Modules\Search\Http\Controllers\LinkController;
use App\Modules\Search\Http\Controllers\PublicFolderController;
use App\Modules\Search\Http\Controllers\SearchController;
use App\Modules\Search\Http\Controllers\UserSearchController;


Route::get('/search', SearchController::class)->name('search');
Route::get('/item/link/{database}/{an}', LinkController::class)->name('item.link');
Route::get('/item/fulltext/{database}/{an}', FulltextController::class)->name('item.fulltext');

Route::middleware(['auth'])->group(function () {

});

