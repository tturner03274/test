<?php

use App\Mail\PartsRequestCreated;

// Homepage
Route::get('/', 'PageController@home');

// Email test
Route::get('/email', function () {
    $partsRequest = \App\PartsRequest::find(1);
    return new PartsRequestCreated($partsRequest);
});

// Scaffold default auth routes
Auth::routes(['verify' => true]);

// Logout link
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Protected routes 
Route::group(['middleware' => ['auth']], function () {

    // Dashboard
    Route::get('dashboard', 'DashboardController@index');

    // Users
    Route::get('users', 'UserController@index');
    Route::get('users/create', 'UserController@create');
    Route::get('users/{id}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::delete('users/{user}', 'UserController@destroy');

    // Active Users
    Route::post('active-users', 'ActiveUserController@store');
    Route::delete('active-users/{user_id}', 'ActiveUserController@destroy');

    // Parts Requests
    Route::get('parts-requests', 'PartsRequestController@index');
    Route::get('parts-requests/{partsRequest}', 'PartsRequestController@show');
    Route::get('parts-requests/create', 'PartsRequestController@create');
    Route::post('parts-requests', 'PartsRequestController@store');

    // Parts Request Images
    Route::post('parts-requests/images', 'PartsRequestImageController@store');

    // Parts Request Bids
    Route::get('parts-requests/{partsRequest}/bids', 'BidController@index');
    Route::get('parts-requests/{partsRequest}/bids/create', 'BidController@create');
    Route::post('parts-requests/{partsRequest}/bids', 'BidController@store')->name('bids.store')->middleware('signed');
    Route::get('parts-requests/{partsRequest}/bids/{bid_id}', 'BidController@show');


    // Important: custom routes before resource
    Route::post('bid/accept', 'BidController@accept')->name('bid.accept');
    Route::post('bid/confirm', 'BidController@confirm')->name('bid.confirm');

    // Bid Lines
    Route::delete('bid-lines', 'BidLineController@destroy')->name('bid-line.delete');
    Route::post('bid-lines', 'BidLineController@store')->name('bid-line.store');


    // Vehcile MOT API request
    Route::post('vehicle-api', 'VehicleAPIController');

    // Get all part types
    Route::get('part-types', 'PartTypeController@index');
});
