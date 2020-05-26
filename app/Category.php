<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    /**
     * Get the events for the category.
     */
    public function events()
    {
        return $this->hasMany('App\Event', 'category_id');
    }
}
