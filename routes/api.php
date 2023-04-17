<?php

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

//Route::post('register', 'API\RegisterController@register');

Route::group(["namespace"=>"Integration"],function () {
    Route::post('check-balance', 'ResellerController@_checkBalance');
    Route::post('detailed-products-list', 'ResellerController@detailedProductsList');
    Route::post('product-detailed-info', 'ResellerController@productDetailedInfo');
    Route::post('purchase-product', 'ResellerController@purchaseProduct');
    Route::post('check-transaction-status', 'ResellerController@checkTransactionStatus');
    Route::post('reconcile', 'ResellerController@reconcile');
});



















Route::group(["middleware"=>["checkPassword", "getLang"], "namespace"=>"API"],function () {
    Route::post('categories', 'CategoriesController@index');
    Route::post('category', 'CategoriesController@getCatById');
    Route::post('category-change-status', 'CategoriesController@changeCatState');
    Route::group(["prefix"=>"admin", "namespace"=>"Admin"],function () {
        Route::post('login', 'AuthAdminController@login');
        Route::post('logout', 'AuthAdminController@logout')-> middleware("auth.gurad:admin_api");
    });
    Route::group(["prefix"=>"user", "namespace"=>"User"],function () {
        Route::post('login', 'AuthUserController@login');
        Route::post('profile', function(){
            return "User Profile !";
        })->middleware(["auth.gurad:user_api"]);
    });
});


/*
Route::group(["middleware"=>["checkAdminToken:admin_api"],"prefix"=>"admin", "namespace"=>"Admin"],function () {
    Route::post('login', 'AuthAdminController@login');
});
*/
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


