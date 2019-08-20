<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Restaurant;
use App\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function showListRestaurants(Request $request)
    {
        $allRestaurants = Restaurant::all();
        return view('restaurant.list', ['restaurants' => $allRestaurants]);
    }

    public function updateRestaurantCalendar($id, Request $request)
    {
        $restaurant = Restaurant::find($id);
        $day = "Choisir le jour";
        $calendar = null;
        $slots = null;
        if ($request->has('day')) {
            if (in_array($request->get('day'), config('enums.week_days'))) {
                $day = $request->get('day');
                $calendar = Calendar::where('id_restaurant', $id)->where('day', $day)->first();
                if ($calendar != null)
                    $slots = Slot::where('id_calendar', $calendar->id)->get();
            }
        }

        return view('restaurant.updateCalendar', ['restaurant' => $restaurant, 'chosenDay' => $day, 'calendar' => $calendar, 'slots' => $slots]);
    }

    public function postUpdateRestaurantCalendar(Request $request)
    {
        $openTime = $request->get('open_time');
        $closeTime = $request->get('close_time');

        try {
            $parsedOpenTime = Carbon::parse($openTime);
            $parsedCloseTime = Carbon::parse($closeTime);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => ['veuillez entrer une heure valide']])->withInputs();
        }


        if ($parsedOpenTime->gt($parsedCloseTime)) {
            return back()->withErrors(['error' => ['l\'heure de fermeture doit être supérieure à l\'heure d\'ouverture']]);
        }

        $slot = new Slot();
        $calendar = Calendar::where('day', $request->get('day'))->where('id_restaurant', $request->get('id_restaurant'))->first();

        if ($calendar == null) {
            $calendar = new Calendar();
            $calendar->id_restaurant = $request->get('id_restaurant');
            $calendar->day = $request->get('day');
            $calendar->type = config('enums.opening_types')['full-time'];
            $calendar->save();

            $slot->id_calendar = $calendar->id;
            $slot->start_time = $parsedOpenTime;
            $slot->close_time = $parsedCloseTime;

        } else {
            $slotsCount = Slot::where('id_calendar', $calendar->id)->count();
            if($calendar->type == config('enums.opening_types')['half-time'] && $slotsCount == 1){
                return back()->withErrors(['error' => ['une demi-journée ne peut contenir qu\'un seul horaire']]);
            }
            $slot->id_calendar = $calendar->id;
            $slot->start_time = $parsedOpenTime;
            $slot->close_time = $parsedCloseTime;

        }
        $slot->save();
        return back();

    }

    public function deleteSlot(Request $request)
    {
        $slot = Slot::find($request->get('id_slot'));
        var_dump($slot);
        var_dump($request->get('id_slot'));
        $slot->delete();
        return back();
    }

    public function changeClosingDay(Request $request)
    {
        $calendar = Calendar::where('day', $request->get('day'))->where('id_restaurant', $request->get('id_restaurant'))->first();
        if ($calendar == null) {
            $calendar = new Calendar();
            $calendar->id_restaurant = $request->get('id_restaurant');
            $calendar->day = $request->get('day');

            if ($request->get('closing_day') == null) {
                $calendar->type = config('enums.opening_types')['full-time'];
            } else {
                $restaurantClosingDay = $this->restaurantHasClosingDay($request->get('id_restaurant'));
                if ($restaurantClosingDay == null) {
                    $calendar->type = config('enums.opening_types')['closing'];
                } else {
                    return back()->withErrors(['error' => ['ce restaurant a déjà un jour de fermeture (' . $restaurantClosingDay . ')']]);
                }
            }

            $calendar->save();
        } else {
            if ($request->get('closing_day') == null) {
                $calendar->type = config('enums.opening_types')['full-time'];
            } else {
                $restaurantClosingDay = $this->restaurantHasClosingDay($request->get('id_restaurant'));
                if ($restaurantClosingDay == null) {
                    $calendar->type = config('enums.opening_types')['closing'];
                } else {
                    return back()->withErrors(['error' => ['ce restaurant a déjà un jour de fermeture (' . $restaurantClosingDay . ')']]);
                }
            }
            $calendar->save();
        }

        return back();
    }

    public function changeHalfDay(Request $request)
    {
        $calendar = Calendar::where('day', $request->get('day'))->where('id_restaurant', $request->get('id_restaurant'))->first();
        if ($calendar == null) {
            $calendar = new Calendar();
            $calendar->id_restaurant = $request->get('id_restaurant');
            $calendar->day = $request->get('day');

            if ($request->get('half_day') == null) {
                $calendar->type = config('enums.opening_types')['full-time'];
            } else {
                $restaurantHalfDay = $this->restaurantHasHalfDay($request->get('id_restaurant'));
                if ($restaurantHalfDay == null) {
                    $calendar->type = config('enums.opening_types')['half-time'];
                } else {
                    return back()->withErrors(['error' => ['ce restaurant a déjà un demi jour (' . $restaurantHalfDay . ')']]);
                }
            }
            $calendar->save();
        } else {
            if ($request->get('half_day') == null) {
                $calendar->type = config('enums.opening_types')['full-time'];
            } else {
                $restaurantHalfDay = $this->restaurantHasHalfDay($request->get('id_restaurant'));
                if ($restaurantHalfDay == null) {
                    $slotsCount = Slot::where('id_calendar', $calendar->id)->count();
                    if ($slotsCount > 1) {
                        return back()->withErrors(['error' => ['ce jour a beaucoup d\'horaires, vous ne devez en laisser qu\'un']]);
                    } else {
                        $calendar->type = config('enums.opening_types')['half-time'];
                    }
                } else {
                    return back()->withErrors(['error' => ['ce restaurant a déjà un demi jour (' . $restaurantHalfDay . ')']]);
                }
            }
            $calendar->save();
        }

        return back();
    }

    private function restaurantHasClosingDay($restaurantId)
    {
        $result = null;
        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant != null) {
            $calendars = Calendar::where('id_restaurant', $restaurantId)->get();
            foreach ($calendars as $calendar) {
                if ($calendar->type == config('enums.opening_types')['closing']) {
                    $result = $calendar->day;
                    break;
                }
            }
        }
        return $result;
    }

    private function restaurantHasHalfDay($restaurantId)
    {
        $result = null;
        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant != null) {
            $calendars = Calendar::where('id_restaurant', $restaurantId)->get();
            foreach ($calendars as $calendar) {
                if ($calendar->type == config('enums.opening_types')['half-time']) {
                    $result = $calendar->day;
                    break;
                }
            }
        }
        return $result;
    }
}
