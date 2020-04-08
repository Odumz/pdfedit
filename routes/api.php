<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::middleware(['auth:api'])->group(function () { 
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/v1/car', 'TicketStatusController@postTicketStatus');
    Route::get('/v1/cars/{name?}', 'TicketStatusController@getTicketStatus');
    Route::put('/v1/cars/{id}', 'TicketStatusController@putTicketStatus');
    Route::delete('/v1/cars/{id}', 'TicketStatusController@deleteTicketStatus');
    Route::get('/webhooks/contacts', 'ContactController@get');
    Route::get('/payload', 'ContactController@getPayload');
    Route::get('/contacts', 'ContactController@getRecentContact');
// });
