<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    //
    protected $table = 'event_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'event_id', 'stripe_charge_id', 'paid_out', 'fees_collected'
    ];

    /**
     * Get the users for the club.
     */
    public function events()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }

    /**
     * Get the users for the club.
     */
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
