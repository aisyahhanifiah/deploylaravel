<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //

    /**
     * The users that belong to the meeting.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'meeting_user');
    }

    /**
     * Get the clubs for meeting.
     */
    public function clubs()
    {
        return $this->belongsTo('App\Club', 'club_id');
    }

    /**
     * Get the clubs for meeting.
     */
    public function meetinguser()
    {
        return $this->hasMany('App\UserMeeting', 'meeting_id');
    }
}
