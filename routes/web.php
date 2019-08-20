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
    return view('welcome');
});

Route::get('/restaurants', 'RestaurantController@showListRestaurants')->name('restaurant.list');
