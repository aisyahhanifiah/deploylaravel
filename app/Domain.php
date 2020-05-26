<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    //

    /**
     * Get the events for the domain.
     */
    public function events()
    {
        return $this->hasMany('App\Event', 'domain_id');
    }

    /**
     * Get the clubs for the domain.
     */
    public function clubs()
    {
        return $this->hasMany('App\Club', 'domain_id');
    }
}
