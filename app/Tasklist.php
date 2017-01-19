<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    //

    /**
     * Get the user that owns the tasklist.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
