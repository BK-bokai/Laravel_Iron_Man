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
Route::middleware('checkLogin')->group(function () {
    Route::get('/', 'HomeController@indexPage');

    //使用者
    Route::group(['prefix' => 'user'], function () {
        Route::get('/sign-up', 'UserAuthController@signUpPage');
        Route::post('/sign-up', 'UserAuthController@signUpProcess')->name('do_signUp');
        Route::get('/sign-in', 'UserAuthController@signInPage')->name('signIn');
        Route::post('/sign-in', 'UserAuthController@signInProcess')->name('do_signIn');
        Route::get('/sign-out', 'UserAuthController@signOut')->name('signOut');
    });

    // Route::get('/merchandise', 'MerchandiseController@merchandiseListPage')->name('merchandise_home');
    // Route::get('/merchandise/{merchandise_id}', 'MerchandiseController@merchandiseItemPage');

    // Route::post('/merchandise/{merchandise_id}/buy', 'MerchandiseController@merchandiseItemBuyProcess');

    // Route::get('/merchandise/create', 'MerchandiseController@merchandiseCreateProcess')->name('merchandise_create');
    // Route::get('/merchandise/manage', 'MerchandiseController@merchandiseManageListPage');
    // Route::get('/merchandise/{merchandise_id}/edit', 'MerchandiseController@merchandiseEditPage')->name('merchandise_edit');
    // Route::put('/merchandise/{merchandise_id}/', 'MerchandiseController@merchandiseItemUpdateProcess')->name('merchandise_update');



    //商品
    // Route::group(['prefix' => 'merchandise'], function () {
    Route::prefix('merchandise')->group(function () {

        Route::get('/', 'MerchandiseController@merchandiseListPage')->name('merchandise_home');



        Route::middleware('checkAdmin','auth')->group(function () {
            Route::get('/create', 'MerchandiseController@merchandiseCreateProcess')->name('merchandise_create');
            Route::get('/manage', 'MerchandiseController@merchandiseManageListPage')->name('merchandise_manage');
            //指定商品
            Route::group(['prefix' => '{merchandise_id}'], function () {
                Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess')->name('merchandise_update');
                Route::get('/edit', 'MerchandiseController@merchandiseEditPage')->name('merchandise_edit');
            });
        });
        Route::group(['prefix' => '{Merchandise}'], function () {
            Route::get('/', 'MerchandiseController@merchandiseItemPage')->name('merchandise_item');
            Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess')->middleware('auth')->name('merchandise_buy');
        });


    });



    //交易
    Route::middleware('auth')->group(function () {
        Route::get('/transaction', 'TransactionController@transactionListPage')->name('trade');
    });
});
