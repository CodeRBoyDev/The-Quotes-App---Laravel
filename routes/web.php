<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AdminController;

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


Route::get('/{author?}', 'App\Http\Controllers\QuoteController@getIndex')->name('index');
Route::post('/', 'App\Http\Controllers\QuoteController@postQuote')->name('quote.postQuote');

Route::get('/delete/{quote_id}', 'App\Http\Controllers\QuoteController@deleteQuote')->name('delete');

Route::get('/gotemail/{author_name}', 'App\Http\Controllers\QuoteController@getMailCallback')->name('mail_callback');


Route::get('/admin/login', 'App\Http\Controllers\AdminController@getLogin')->name('admin.login');
Route::post('/admin/login', 'App\Http\Controllers\AdminController@postLogin')->name('admin.postlogin');



    Route::group(['middleware'=>'auth'] , function(){

        Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@getDashboard')->name('admin.dashboard');

        Route::get('/admin/logout', 'App\Http\Controllers\AdminController@getLogout')->name('admin.logout');



    });





