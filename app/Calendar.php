<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer id_restaurant
 * @property string day
 * @property string type
 */
class Calendar extends Model
{
    protected $table = "calendar";

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant', 'id_restaurant');
    }

    public function slots()
    {
        return $this->hasMany('App\Slot', 'id_calendar');
    }
}
