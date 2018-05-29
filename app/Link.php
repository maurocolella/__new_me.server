<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function work()
    {
        return $this->belongsTo('App\Work')->withTimestamps();
    }
}
