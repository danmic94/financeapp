<?php
use App\Expenses as ExpensesModel;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('expenses','ExpensesController@index');
Route::get('expenses/{expenses}', 'ExpensesController@show');
Route::post('expenses','ExpensesController@create');
Route::put('expenses/{expenses}','ExpensesController@update');
Route::delete('expenses/{expenses}','ExpensesController@delete');


