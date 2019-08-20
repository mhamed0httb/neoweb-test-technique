<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer id_calendar
 * @property integer start_time
 * @property integer close_time
 */
class Slot extends Model
{
    protected $table = "slots";

    public function calendar()
    {
        return $this->belongsTo('App\Calendar', 'id_calendar');
    }
}
