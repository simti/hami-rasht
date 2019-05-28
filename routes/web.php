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

Route::namespace('Panel')->group(function () {
  Route::prefix('donees')->name('donees.')->group(function () {
    Route::get('/list', 'DoneesController@index')->name('index');
    Route::get('/create', 'DoneesController@create')->name('create');
    Route::post('/store', 'DoneesController@store')->name('store');
    Route::get('/show/{donee?}', 'DoneesController@show')->name('show');
    Route::get('/edit/{donee?}', 'DoneesController@edit')->name('edit');
    Route::patch('/update/{donee}', 'DoneesController@update')->name('update');
    Route::get('/remove/{donee}', 'DoneesController@remove')->name('remove');
    Route::get('/delete', 'DoneesController@delete')->name('delete');
    Route::get('/fetch', 'DoneesController@fetch')->name('fetch');
    Route::get('/count', 'DoneesController@count')->name('count');
  });

  Route::prefix('donors')->name('donors.')->group(function () {
    Route::get('/list', 'DonorsController@index')->name('index');
    Route::get('/create', 'DonorsController@create')->name('create');
    Route::post('/store', 'DonorsController@store')->name('store');
    Route::get('/show/{donor?}', 'DonorsController@show')->name('show');
    Route::get('/edit/{donor?}', 'DonorsController@edit')->name('edit');
    Route::patch('/update/{donor}', 'DonorsController@update')->name('update');
    Route::get('/remove/{donor}', 'DonorsController@remove')->name('remove');
    Route::get('/delete', 'DonorsController@delete')->name('delete');
    Route::get('/fetch', 'DonorsController@fetch')->name('fetch');
    Route::get('/count', 'DonorsController@count')->name('count');
  });

  Route::prefix('periods')->name('periods.')->group(function () {
    Route::get('/list', 'PeriodsController@index')->name('index');
    Route::get('/fetch', 'PeriodsController@fetch')->name('fetch');
    Route::get('/count', 'PeriodsController@count')->name('count');
    Route::get('/store', 'PeriodsController@store')->name('store');
  });

  Route::prefix('transactions')->name('transactions.')->group(function () {
    // Route::get('/list', 'DonorsController@index')->name('index');
    Route::get('/create', 'TransactionsController@create')->name('create');
    Route::get('/store', 'TransactionsController@store')->name('store');
    Route::get('/fetch_related_donees', 'TransactionsController@fetch_related_donees')->name('related_donees');
    Route::get('/fetch_info', 'TransactionsController@fetch_info')->name('fetch_info');
  });
});
