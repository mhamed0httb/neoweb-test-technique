<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class Restaurant extends Model
{

    protected $table = "restaurants";

    protected $attributes = [
        'name'
    ];
}
