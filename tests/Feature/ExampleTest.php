<?php

namespace Tests\Feature;

use App\Calendar;
use App\Restaurant;
use App\Slot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

  

    /** @test */
    public function a_slot_must_be_deleted()
    {
        $response = $this->post('/restaurants/slot/delete', [
            'id_slot' => 100
        ]);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function restaurant_must_have_unique_closing_day()
    {

        $resto = new Restaurant();
        $resto->name = "test";
        $resto->save();

        $this->assertLessThanOrEqual(1, Calendar::where('id_restaurant', $resto->id)
            ->where('type', config('enums.opening_types')['closing'])
            ->count()
        );
    }

    /** @test */
    public function open_and_close_times_must_be_valid()
    {

        $resto = new Restaurant();
        $resto->name = "test";
        $resto->save();
        $data = [
            'id_restaurant' => $resto->id,
            'day' => config('enums.week_days')['Sunday'],
            'open_time' => Carbon::parse("10:30 am"),
            'close_time' => Carbon::parse("8 am")
        ];
        $response = $this->post('/restaurants/calendar/update', $data);
        $response->assertSessionHasNoErrors();
    }

}
