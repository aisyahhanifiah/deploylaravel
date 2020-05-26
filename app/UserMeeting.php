<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeeting extends Model
{
    //
    protected $table = 'meeting_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'meeting_id',
    ];

    /**
     * Get the users for the club.
     */
    public function meetings()
    {
        return $this->belongsTo('App\Event', 'meeting_id');
    }

    /**
     * Get the users for the club.
     */
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
