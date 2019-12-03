<?php

use App\Attributes;
use App\Http\Controllers\Api\v1\AttributesController;
use App\Http\Controllers\Api\v1\CustomersController;
use App\Http\Controllers\Api\v1\DeliveriesController;
use App\Http\Controllers\Api\v1\EmployeesController;
use App\Http\Controllers\Api\v1\CategoriesController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\OrdersController;
use App\Http\Controllers\Api\v1\ListingsController;
use App\Http\Controllers\Api\v1\StocksController;
use App\Http\Controllers\Api\v1\TransactionController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Api Version v1
 */
Route::prefix('masterkids')->group(function() {
    Route::prefix('v1')->group(function(){

        /**
         * Admin Routes
         */
//        Route::prefix('admin')->group(function() {
//            //CREATE
//            Route::post('login', [EmployeesController::class, 'login']);
//            Route::post('', [EmployeesController::class, 'register']);
//
//            //READ
//            Route::get('', [EmployeesController::class, 'getEmployees']);
//            Route::get('{id}', [EmployeesController::class, 'getEmployeeById'])->where('id', '[0-9]+');
//            Route::get('{type}', [EmployeesController::class, 'getEmployeesByType'])->where('name', '[A-Za-z]+');
//
//            //UPDATE
//            Route::put('{id}', [EmployeesController::class, 'update'])->where('id', '[0-9]+');
//            Route::put('{id}/name', [EmployeesController::class, 'updateName'])->where('id', '[0-9]+');
//            Route::put('{id}/password', [EmployeesController::class, 'updatePassword'])->where('id', '[0-9]+');
//            Route::put('{id}/email', [EmployeesController::class, 'updateEmail'])->where('id', '[0-9]+');
//            Route::put('{id}/type', [EmployeesController::class, 'updateType'])->where('id', '[0-9]+');
//            Route::put('{id}/status', [EmployeesController::class, 'updateStatus'])->where('id', '[0-9]+');
//
//            //DELETE
//            Route::delete('{id}', [EmployeesController::class, 'destroy'])->where('id', '[0-9]+');
//            Route::delete('all', [EmployeesController::class, 'destroyAll']);
//        });

        /**
         * Categories Routes
         */
        Route::prefix('categories')->group(function() {
            //CREATE
            Route::post('', [CategoriesController::class, 'store']);

            //READ
            Route::get('', [CategoriesController::class, 'getCategories']);
            Route::get('{id}', [CategoriesController::class, 'getCategoryById'])->where('id', '[0-9]+');
            Route::get('code/{code}', [CategoriesController::class, 'getCategoryByCode'])->where('code', '[0-9a-zA-z]+');

            //UPDATE
            Route::put('{id}', [CategoriesController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/code', [CategoriesController::class, 'updateCode'])->where('id', '[0-9]+');
            Route::put('{id}/name', [CategoriesController::class, 'updateName'])->where('id', '[0-9]+');
            Route::put('{id}/description', [CategoriesController::class, 'updateDescription'])->where('id', '[0-9]+');

            //DELETE
            Route::delete('{id}', [CategoriesController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('all', [CategoriesController::class, 'destroyAll'])->where('id', '[0-9]+');
        });

        /**
         * Products Routes
         */
        Route::prefix('listings')->group(function() {
            //CREATE
            Route::post('', [ListingsController::class, 'store']);

            //READ
            Route::get('', [ListingsController::class, 'getListings']);
            Route::get('paginate', [ListingsController::class, 'paginate']);
            Route::get('{id}', [ListingsController::class, 'getListingById'])->where('id', '[0-9]+');
            Route::get('{id}/attribute', [ListingsController::class, 'getListingByIdWithAttributes'])->where('id', '[0-9]+');

            //UPDATE
            Route::put('{id}/edit', [ListingsController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/edit/name', [ListingsController::class, 'updateName'])->where('id', '[0-9]+');
            Route::put('{id}/edit/price', [ListingsController::class, 'updatePrice'])->where('id', '[0-9]+');
            Route::put('{id}/edit/description', [ListingsController::class, 'updateDescription'])->where('id', '[0-9]+');

            //DELETE
            Route::delete('{id}', [ListingsController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('all', [ListingsController::class, 'destroyAll']);
        });

        /**
         * Attributes Routes
         */
        Route::prefix('attributes')->group(function() {
            //CREATE
            Route::post('', [AttributesController::class, 'store']);

            //READ
            Route::get('', [AttributesController::class, 'getAttributes']);
            Route::get('{id}', [AttributesController::class, 'getAttributeById'])->where('id', '[0-9]+');
            Route::get('name/{name}', [AttributesController::class, 'getAttributeByName'])->where('name', '[0-9a-zA-z]+');

            //UPDATE
            Route::put('{attribute_id}/name', [AttributesController::class, 'updateAttributeName'])->where('attribute_id', '[0-9]+');
            Route::put('{value_id}/value', [AttributesController::class, 'updateAttributeValue'])->where('value_id', '[0-9]+');

            //DELETE
            Route::delete('{id}', [AttributesController::class, 'destroy'])->where('id', '[0-9]+');
        });

        /**
         * Products Routes
         */
        Route::prefix('stocks')->group(function() {
            //CREATE
            Route::post('', [StocksController::class, 'store']);

             //READ
            Route::get('', [StocksController::class, 'getStocks']);
            Route::get('{id}', [StocksController::class, 'getStockById'])->where('id', '[0-9]+');
            Route::get('listing/{id}', [StocksController::class, 'getStockByListingId'])->where('id', '[0-9]+');

            //UPDATE
            Route::put('{id}', [StocksController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/quantity', [StocksController::class, 'updateQuantity'])->where('id', '[0-9]+');
            Route::put('listing/{id}/quantity', [StocksController::class, 'updateQuantityByListingId'])->where('id', '[0-9]+');

            //DELETE
            Route::delete('{id}', [StocksController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('listing/{id}', [StocksController::class, 'destroyByListingId'])->where('id', '[0-9]+');
        });
    });
});
