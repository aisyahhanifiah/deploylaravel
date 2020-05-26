<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //

    /**
     * Get the events for the level.
     */
    public function events()
    {
        return $this->hasMany('App\Event', 'level_id');
    }
}
