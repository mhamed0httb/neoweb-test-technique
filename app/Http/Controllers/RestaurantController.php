<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function showListRestaurants(Request $request)
    {
        return view('restaurant.list');
    }
}
