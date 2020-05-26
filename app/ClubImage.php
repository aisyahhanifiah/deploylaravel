<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClubImage extends Model
{
    //
    protected $table = 'club_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'club_id',
    ];

    /**
     * Get the images for the club.
     */
    public function clubs()
    {
        return $this->belongsTo('App\Club');
    }
}
