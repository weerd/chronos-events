<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('chronos', function() {
    return ['status' => 'Chronos Events routes are working!'];
});

// Admin Routes
Route::group(['namespace' => 'Weerd\ChronosEvents\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
    Route::resource('events', 'CalendarEventController', ['as' => 'admin']);
});

// Client Routes
Route::group(['namespace' => 'Weerd\ChronosEvents\Http\Controllers\Client'], function () {
    Route::get('events', 'CalendarEventController@index')->name('client.events.index');
    // Route::get('events/{id}', 'CalendarEventController@show')->name('client.events.show');
});
