<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Club extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'semester', 'description', 'domain_id', 'requirement', 'capacity', 'fees', 'url_fb', 'url_ig', 'url_email', 'stripe_connect_id',
    ]; 

    /**
     * The users that belong to the club.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'club_user');
    }

    /**
     * The meetings that belong to the club.
     */
    public function meetings()
    {
        return $this->hasMany('App\Meeting', 'club_id');
    }

    /**
     * The positions that belong to the club.
     */
    public function positions()
    {
        return $this->belongsToMany('App\Position', 'club_user', 'position_id');
    }

    /**
     * Get the images for the club.
     */
    public function images()
    {
        return $this->hasMany('App\ClubImage');
    }

    /**
     * Get the events for the club.
     */
    public function events()
    {
        return $this->hasMany('App\Event', 'club_id');
    }

    /**
     * Get the domain for the clubs.
     */
    public function domains()
    {
        return $this->belongsTo('App\Domain','domain_id');
    }


    /**
     * The clubs that belong to the user.
     */
    public function clubuser()
    {
        return $this->hasMany('App\UserClub', 'club_id');
    }
    // public function getTableColumns()
    // {
    //     $query = "SELECT column_name FROM information_schema.columns WHERE table_name = 'clubs'";
    //     $result = DB::select($query);
    //     // dd($result);
    // }
}
