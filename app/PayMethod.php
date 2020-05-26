<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayMethod extends Model
{
    //

    /**
     * Get the userclubs for the payment method.
     */
    public function userclub()
    {
        return $this->hasMany('App\UserClub');
    }

    /**
     * Get the userevents for the payment method.
     */
    public function userevent()
    {
        return $this->hasMany('App\UserEvent');
    }
}
