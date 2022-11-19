<?php

use App\Http\Controllers\AttractionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'attractions', 'middleware'=>'auth:sanctum', 'controller' => AttractionController::class], function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{attraction}', 'show');
    Route::post('/{attraction}', 'update');
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/get', function (){
        return response()->json(['get'=>'success']);
    });
});

