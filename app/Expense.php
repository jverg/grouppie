<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    /**
     * One expense must have a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Users() {
        return $this->belongsTo('App\User');
    }
}
