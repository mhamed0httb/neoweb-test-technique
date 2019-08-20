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

use App\Restaurant;

Route::get('/', function () {
    $restaurant = new Restaurant();
   /*
    *  $restaurant->__set("name", "naaaame");
    $restaurant->__get("name");
    */
    $restaurant->setAttribute("names", "somethingggg");
    $restaurant->name = "eee";
    $restaurant->getAttribute("name");
    var_dump($restaurant->name);
    var_dump(config('enums.week_days')["Monday"]);
    var_dump(config('enums.opening_types'));

    $rest = new Restaurant();
    $rest->name = "Restaurant test";
    $rest->save();
    return view('welcome');
});

Route::get('/restaurants', 'RestaurantController@showListRestaurants')->name('restaurant.list');
Route::get('/restaurants/{id}/calendar', 'RestaurantController@updateRestaurantCalendar')->name('restaurant.calendar');
Route::post('/restaurants/calendar/update', 'RestaurantController@postUpdateRestaurantCalendar')->name('restaurant.calendar.update');
Route::post('/restaurants/slot/delete', 'RestaurantController@deleteSlot')->name('slot.delete');
Route::post('/restaurants/calendar/closing-day', 'RestaurantController@changeClosingDay')->name('calendar.closing_day');
Route::post('/restaurants/calendar/half-day', 'RestaurantController@changeHalfDay')->name('calendar.half_day');
