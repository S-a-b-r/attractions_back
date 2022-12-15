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

Route::group(['prefix' => 'attractions', 'controller' => AttractionController::class], function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{attraction}', 'show');
    Route::post('/{attraction}', 'update');
});

Route::post('/search', [\App\Http\Controllers\SearchController::class, 'search']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::get('/get', function (){
//        return response()->json(['get'=>'success']);
//    });
//});

