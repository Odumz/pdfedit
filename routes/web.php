<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::middleware(['auth:api'])->group(function () {
    Route::get('/', 'ContactController@home');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/editBusinessSLA', 'HomeController@editBuisnessSLA')->name('editBusinessSLA');

    Route::post('/editTalentSLA', 'HomeController@editTalentSLA')->name('editTalentSLA');

    Route::post('/s3-upload', 'HomeController@s3upload')->name('s3test');

    Route::get('/pdf', 'HomeController@pdf')->name('pdf');

    Route::get('/s3-show', 'HomeController@s3show')->name('pdf');
// });
