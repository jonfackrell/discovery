<?php

use App\Modules\Search\Http\Controllers\ExportController;
use App\Modules\Search\Http\Controllers\FolderController;
use App\Modules\Search\Http\Controllers\FulltextController;
use App\Modules\Search\Http\Controllers\ItemController;
use App\Modules\Search\Http\Controllers\LikeController;
use App\Modules\Search\Http\Controllers\PublicFolderController;
use App\Modules\Search\Http\Controllers\SearchController;
use App\Modules\Search\Http\Controllers\UserSearchController;

Route::get('/search', SearchController::class)->name('search');

Route::middleware(['auth'])->group(function () {
    Route::get('/item/{item}', ItemController::class)->name('item.view');
    Route::get('/item/{item}/fulltext', FulltextController::class)->name('item.fulltext');


    // My Account
    Route::get('/likes', LikeController::class)->name('account.likes');
    Route::get('/folders', FolderController::class)->name('account.folders');
    Route::get('/folder/{uuid}/public', PublicFolderController::class)->name('folder.link.public');

    Route::get('/user/search', UserSearchController::class)->name('user.search');
});

Route::get('/export/{records}', ExportController::class)->name('export.refworks');
