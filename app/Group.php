<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    /**
     * One ugroup may have many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\User');
    }
}
