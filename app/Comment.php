<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{

    /**
     * One comment must have a post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo('App\Post');
    }
}
