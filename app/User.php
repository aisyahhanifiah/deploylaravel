<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'unikl_id', 'phone_no', 'gender', 'image', 'dob', 'stripe_user_id', 'roles', 'stripe_card', 'stripe_type'
    ];

    protected $dates = ['created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The clubs that belong to the user.
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Club', 'club_user')->withPivot('position_id', 'club_id', 'user_id', 'created_at','stripe_charge_id', 'paid_out', 'fees_collected');
    }

    /**
     * The clubs that belong to the user.
     */
    public function stripenull()
    {
        return $this->belongsToMany('App\Club', 'club_user')->withPivot('id', 'position_id', 'club_id', 'user_id', 'created_at', 'updated_at', 'stripe_charge_id', 'paid_out', 'fees_collected')->wherePivot('stripe_charge_id', NULL);
    }

    /**
     * The clubs that belong to the user.
     */
    public function stripeexist()
    {
        return $this->belongsToMany('App\Club', 'club_user')->withPivot('id', 'position_id', 'club_id', 'user_id', 'created_at', 'updated_at','stripe_charge_id', 'paid_out', 'fees_collected')->wherePivot('stripe_charge_id', '!=', NULL);
    }

    /**
     * The positions that belong to the user.
     */
    public function positions()
    {
        return $this->belongsToMany('App\Position', 'club_user', 'position_id');
    }

    /**
     * The events that belong to the user.
     */
    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_user')->withPivot('id', 'event_id', 'user_id', 'created_at', 'updated_at', 'stripe_charge_id', 'paid_out', 'fees_collected');
    }

    public function stripenulleve()
    {
        return $this->belongsToMany('App\Event', 'event_user')->withPivot('id', 'event_id', 'user_id', 'created_at', 'updated_at', 'stripe_charge_id', 'paid_out', 'fees_collected')->wherePivot('stripe_charge_id', NULL);
    }

    /**
     * The clubs that belong to the user.
     */
    public function stripeexisteve()
    {
        return $this->belongsToMany('App\Event', 'event_user')->withPivot('id', 'event_id', 'user_id', 'created_at', 'updated_at','stripe_charge_id', 'paid_out', 'fees_collected')->wherePivot('stripe_charge_id', '!=', NULL);
    }

    /**
     * The meetings that belong to the user.
     */
    public function meetings()
    {
        return $this->belongsToMany('App\Meeting', 'meeting_user');
    }

    public function isAdmin()
    {
        // $admin = Str::contains("admin")
        if (Str::contains($this->roles, 'admin')) {
            return true;
        }
        else false;
        // return $this->admin ? true : false; // this looks for an admin column in your users table
    }

    public function isCommittee()
    {
        if (Str::contains($this->roles, 'committee')) {
            return true;
        }
        else false;
        // return $this->admin ? true : false; // this looks for an admin column in your users table
    }

    /**
     * The clubs that belong to the user.
     */
    public function clubuser()
    {
        return $this->hasMany('App\UserClub', 'user_id');
    }

    /**
     * The clubs that belong to the user.
     */
    public function eventuser()
    {
        return $this->hasMany('App\UserEvent', 'user_id');
    }

    /**
     * The clubs that belong to the user.
     */
    public function meetinguser()
    {
        return $this->hasMany('App\UserMeeting', 'user_id');
    }
}
