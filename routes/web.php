<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

/**
 * START: Admin
 */

// Dashboard
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

 // Securities
Route::resource('security', 'SecurityController');
Route::get('get-data-security', 'SecurityController@getData')->name('get-data-security');

// Daily
Route::resource('daily', 'DailyController');
Route::get('get-daily-data', 'DailyController@getDailyData')->name('get-daily-data');
;
// Daily
Route::resource('data-apar', 'DataAparController');
Route::get('get-apar-data', 'DataAparController@getAparData')->name('get-apar-data');
/**
 * END: Admin
 */
Auth::routes();
