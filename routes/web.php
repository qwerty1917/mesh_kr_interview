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

Route::get('/error503/', function () {
    return view('errors.503');
});

Route::get('/practice/', function () {
    $view = view('practice');
    $view->greeting = "Hey~ What's up";
    $view->name = 'everyone';
    $view->items = ["first item", "second item", "third item"];

    return $view;
});

Route::get('/', [
    'as'   => 'main',
    'uses' => 'DashboardController@dashboard'
]);



Route::get('holding_items', [
    'as'   => 'holding_items.index',
    'uses' => 'HoldingItemsController@index'
]);

Route::resource('holding_items', 'HoldingItemsController');

Route::post('deal/post', 'DashboardController@deal_post');