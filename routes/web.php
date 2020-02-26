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

// Route::get('/', function () {
//     return view('welcome');
// });

// 首頁
Route::get('/', 'HomeController@indexPage');

//使用者
Route::group(['prefix' => 'user'], function () {
    Route::get('/sign-up', 'UserAuthController@signUpPage');
    Route::post('/sign-up', 'UserAuthController@signUpProcess')->name('do_signUp');
    Route::get('/sign-in', 'UserAuthController@signInPage')->name('signIn');
    Route::post('/sign-in', 'UserAuthController@signInProcess')->name('do_signIn');
    Route::get('/sign-out', 'UserAuthController@signOut')->name('signOut');
});


//商品
Route::group(['prefix' => 'merchandise'], function () {
    Route::get('/', 'MerchandiseController@merchandiseListPage');
    Route::get('/create', 'MerchandiseController@merchandiseCreateProcess');
    Route::get('/manage', 'MerchandiseController@merchandiseManageListPage');
    //指定商品
    Route::group(['prefix' => '{merchandise_id}'], function () {
        Route::get('/', 'MerchandiseController@merchandiseItemPage');
        Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess');
        Route::get('/edit', 'MerchandiseController@merchandiseEditPage')->name('merchandise_edit');
        Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess');
    });
});







//交易
// Route::middleware('auth')->group(function () {
    Route::get('/transaction', 'TransactionController@transactionListPage')->name('trade');
// });
