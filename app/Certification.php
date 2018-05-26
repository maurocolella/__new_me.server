<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    public function profile()
    {
        return $this->belongsTo('App\Profile')->withTimestamps();
    }
}
