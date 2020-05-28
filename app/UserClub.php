<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserClub extends Model
{
    //
    protected $table = 'club_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'club_id', 'position_id', 'stripe_charge_id', 'paid_out', 'fees_collected', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the users for the club.
     */
    public function clubs()
    {
        return $this->belongsTo('App\Club', 'club_id');
    }

    /**
     * Get the users for the club.
     */
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the positions for the club.
     */
    public function positions()
    {
        return $this->belongsTo('App\Position', 'position_id');
    }
}
