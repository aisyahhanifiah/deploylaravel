<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'venue', 'level_id', 'category_id', 'domain_id', 'club_id', 'requirement', 'capacity', 'fees', 'stripe_connect_id',
    ]; 

    /**
     * The users that belong to the event.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'event_user')->withPivot('id', 'event_id', 'user_id', 'created_at', 'updated_at', 'stripe_charge_id', 'paid_out', 'fees_collected');
    }

    /**
     * Get the images for the event.
     */
    public function images()
    {
        return $this->hasMany('App\EventImage');
    }

    /**
     * Get the club for the event.
     */
    public function clubs()
    {
        return $this->belongsTo('App\Club', 'club_id');
    }

    /**
     * Get the domain for the event.
     */
    public function domains()
    {
        return $this->belongsTo('App\Domain','domain_id');
    }

    /**
     * Get the category for the event.
     */
    public function categories()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    /**
     * Get the level for the event.
     */
    public function levels()
    {
        return $this->belongsTo('App\Level','level_id');
    }

    /**
     * The clubs that belong to the user.
     */
    public function eventuser()
    {
        return $this->hasMany('App\UserEvent', 'event_id');
    }
}
