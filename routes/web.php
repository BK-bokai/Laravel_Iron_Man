<?php

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

// 首頁
Route::get('/', 'HomeController@indexPage');

//使用者
Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::get('/auth/sign-up', 'UserAuthController@signUpPage');
    Route::post('/auth/sign-up', 'UserAuthController@signUpProcess');
    Route::get('/auth/sign-in', 'UserAuthController@signInPage');
    Route::post('/auth/sign-in', 'UserAuthController@signInProcess');
    Route::get('/auth/sign-out', 'UserAuthController@signOut');
});


//商品
Route::group(['prefix' => 'merchandise', 'namespace' => 'backend'], function () {
    Route::get('/', 'MerchandiseController@merchandiseListPage');
    Route::get('/create', 'MerchandiseController@merchandiseCreateProcess');
    Route::get('/manage', 'MerchandiseController@merchandiseManageListPage');
    //指定商品
    Route::group(['prefix' => '{merchandise_id}'], function () {
        Route::get('/', 'MerchandiseController@merchandiseItemPage');
        Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess');
        Route::get('/edit', 'MerchandiseController@merchandiseEditPage');
        Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess');
    });
});







//交易
Route::get('/transaction', 'TransactionController@transactionListPage');
