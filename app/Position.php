<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //

    /**
     * The users that belong to the position.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'club_user', 'position_id');
    }


    /**
     * The users that belong to the position.
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Club', 'club_user', 'position_id');
    }

    /**
     * The clubs that belong to the user.
     */
    public function clubuser()
    {
        return $this->hasMany('App\UserClub', 'position_id');
    }
}
