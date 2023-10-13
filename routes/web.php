<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTableController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/items', 'DataTableController@index');

Route::get('/items', [DataTableController::class, 'index']);


Route::get('data-table', [DataTableController::class, 'index'])->name('data-table');
Route::post('data-table/data', [DataTableController::class, 'data'])->name('data-table.data');

Route::post('/selected-employee', [DataTableController::class, 'updateAll'])->name('employee.update');
