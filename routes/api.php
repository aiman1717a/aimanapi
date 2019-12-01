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
         * Admon Routes
         */
        Route::prefix('admin')->group(function() {
            Route::post('login', [EmployeesController::class, 'login']);
            Route::post('', [EmployeesController::class, 'register']);
            Route::get('', [EmployeesController::class, 'getEmployees']);
            Route::get('{id}', [EmployeesController::class, 'getEmployeeById'])->where('id', '[0-9]+');
            Route::get('{type}', [EmployeesController::class, 'getEmployeesByType'])->where('name', '[A-Za-z]+');
            Route::put('{id}', [EmployeesController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/name', [EmployeesController::class, 'updateName'])->where('id', '[0-9]+');
            Route::put('{id}/password', [EmployeesController::class, 'updatePassword'])->where('id', '[0-9]+');
            Route::put('{id}/email', [EmployeesController::class, 'updateEmail'])->where('id', '[0-9]+');
            Route::put('{id}/type', [EmployeesController::class, 'updateType'])->where('id', '[0-9]+');
            Route::put('{id}/status', [EmployeesController::class, 'updateStatus'])->where('id', '[0-9]+');
            Route::delete('{id}', [EmployeesController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('all', [EmployeesController::class, 'destroyAll']);
        });

        /**
         * Categories Routes
         */
        Route::prefix('categories')->group(function() {
            Route::post('', [CategoriesController::class, 'store']);
            Route::get('', [CategoriesController::class, 'getCategories']);
            Route::get('{id}', [CategoriesController::class, 'getCategoryById'])->where('id', '[0-9]+');
            Route::get('code/{code}', [CategoriesController::class, 'getCategoryByCode'])->where('code', '[0-9a-zA-z]+');
            Route::put('{id}', [CategoriesController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/code', [CategoriesController::class, 'updateCode'])->where('id', '[0-9]+');
            Route::put('{id}/name', [CategoriesController::class, 'updateName'])->where('id', '[0-9]+');
            Route::put('{id}/description', [CategoriesController::class, 'updateDescription'])->where('id', '[0-9]+');
            Route::delete('{id}', [CategoriesController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('all', [CategoriesController::class, 'destroyAll'])->where('id', '[0-9]+');
        });

        /**
         * Products Routes
         */
        Route::prefix('listings')->group(function() {
            Route::post('', [ListingsController::class, 'store']);
            Route::get('', [ListingsController::class, 'index']);
            Route::get('paginate', [ListingsController::class, 'paginate']);
            Route::get('{id}', [ListingsController::class, 'getListingById'])->where('id', '[0-9]+');
            Route::put('{id}/edit', [ListingsController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/edit/name', [ListingsController::class, 'updateName'])->where('id', '[0-9]+');
            Route::put('{id}/edit/price', [ListingsController::class, 'updatePrice'])->where('id', '[0-9]+');
            Route::put('{id}/edit/description', [ListingsController::class, 'updateDescription'])->where('id', '[0-9]+');
            Route::delete('{id}', [ListingsController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('all', [ListingsController::class, 'destroyAll']);
        });

        /**
         * Products Routes
         */
        Route::prefix('attributes')->group(function() {
            Route::post('', [AttributesController::class, 'store']);
            Route::get('', [AttributesController::class, 'index']);
            Route::put('{id}/edit', [AttributesController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('{id}', [AttributesController::class, 'destroy'])->where('id', '[0-9]+');
        });

        /**
         * Products Routes
         */
        Route::prefix('stocks')->group(function() {
            Route::post('', [StocksController::class, 'store']);
            Route::get('', [StocksController::class, 'getAllStock']);
            Route::get('{id}', [StocksController::class, 'getStockById'])->where('id', '[0-9]+');
            Route::get('listing/{id}', [StocksController::class, 'getStockByListingId'])->where('id', '[0-9]+');
            Route::put('{id}', [StocksController::class, 'update'])->where('id', '[0-9]+');
            Route::put('{id}/quantity', [StocksController::class, 'updateQuantity'])->where('id', '[0-9]+');
            Route::put('{id}/quantity_per_unit', [StocksController::class, 'updateQuantityPerUnit'])->where('id', '[0-9]+');
            Route::put('listing/{id}/quantity', [StocksController::class, 'updateQuantityByListingId'])->where('id', '[0-9]+');
            Route::put('listing/{id}/quantity_per_unit', [StocksController::class, 'updateQuantityPerUnitByListingId'])->where('id', '[0-9]+');
            Route::delete('{id}', [StocksController::class, 'destroy'])->where('id', '[0-9]+');
            Route::delete('listing/{id}', [StocksController::class, 'destroyByListingId'])->where('id', '[0-9]+');
        });

        /**
         * Products Routes
         */
        Route::prefix('customer')->group(function() {
            Route::post('', [CustomersController::class, 'store']);
        });

        /**
         * Products Routes
         */
        Route::prefix('order')->group(function() {
            Route::post('', [OrdersController::class, 'store']);
        });

        /**
         * Products Routes
         */
        Route::prefix('deliveries')->group(function() {
            Route::post('', [DeliveriesController::class, 'store']);
        });

    });
});
