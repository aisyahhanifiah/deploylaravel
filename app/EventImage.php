<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    //
    protected $table = 'event_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'event_id',
    ];

    /**
     * Get the images for the event.
     */
    public function events()
    {
        return $this->belongsTo('App\Event');
    }
}
