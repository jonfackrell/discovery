<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "modules" middleware group. Now create something great!
|
*/

Route::group([], base_path('app/Modules/Search/routes.php'));
Route::group([], base_path('app/Modules/Communication/routes.php'));
Route::group([], base_path('app/Modules/Stackmaps/routes.php'));
