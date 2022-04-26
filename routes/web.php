<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FinanceController::class,'index']);
Route::post('/', [FinanceController::class,'store']);
