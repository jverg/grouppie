<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    /**
     * One group may have many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User');
    }

    /**
     * One group may have many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }


}
