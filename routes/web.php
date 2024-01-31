<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\anoController;
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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/getcrop', [anoController::class, 'getcrop']);
Route::get('/getseason', [anoController::class, 'getseason']);
Route::post('/submitdetails', [anoController::class, 'submitdetails']);
Route::get('/', [anoController::class, 'submitdetails']);


