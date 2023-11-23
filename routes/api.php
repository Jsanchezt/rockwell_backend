<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/files', function (Request $request) {
    if ($request->hasFile('images')) {
        $file = $request->file('images')->store("public/files");
        return [
            "success"=> true,
            "url"=> env('APP_FILES_URL').Storage::url($file)
        ];
    }
    return [
        "success"=> false
    ];
});


Route::post('/create_user', 'UserController@store');
Route::get('/products/list', 'ProductController@index_available');
Route::get('/products/best_seller', 'ProductController@best_seller');
Route::get('/product_detail/{product_id}', 'ProductController@show');
Route::get('/categories/list', 'CategoryController@index');
Route::get('/categories/{category_code}/product', 'ProductController@byCategory');




Route::middleware(['auth:api'])->group(function () {
    Route::get('/my_sales', 'SalesController@my_sales');
    Route::post('/sales', 'SalesController@store');

});


Route::middleware(['auth:api','admin'])->group(function () {

    Route::get('me', function (Request $request) {
        return $request->user();
    });

    Route::get('/categories/{category_id}', 'CategoryController@show');
    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@store');
    Route::delete('/categories/{category_id}', 'CategoryController@destroy');


    Route::get('/products', 'ProductController@index');
    Route::post('/products', 'ProductController@store');
    Route::get('/products/{product_id}', 'ProductController@show');
    Route::put('/products/{product_id}', 'ProductController@update');


    Route::get('/sales', 'SalesController@index');
    Route::get('/sales/closed', 'SalesController@index_closed');


    Route::get('/sales/{id}', 'SalesController@show');
    Route::post('/sales/{id}/change_status/{status}', 'SalesController@changeStatus');
    Route::delete('/sales/{id}', 'SalesController@destroy');



});
