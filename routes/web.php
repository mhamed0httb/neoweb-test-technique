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

Route::get('/', 'RestaurantController@showListRestaurants')->name('restaurant.list');
Route::post('/restaurants/create', 'RestaurantController@createRestaurant')->name('restaurant.create');
Route::get('/restaurants/{id}/calendar', 'RestaurantController@updateRestaurantCalendar')->name('restaurant.calendar');
Route::post('/restaurants/calendar/update', 'RestaurantController@postUpdateRestaurantCalendar')->name('restaurant.calendar.update');
Route::post('/restaurants/slot/delete', 'RestaurantController@deleteSlot')->name('slot.delete');
Route::post('/restaurants/calendar/closing-day', 'RestaurantController@changeClosingDay')->name('calendar.closing_day');
Route::post('/restaurants/calendar/half-day', 'RestaurantController@changeHalfDay')->name('calendar.half_day');
Route::get('/restaurants/{id}/details', 'RestaurantController@detailsRestaurant')->name('restaurant.details');