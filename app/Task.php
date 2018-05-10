<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description'];
    //
    public function resumeentries()
    {
        return $this->belongsToMany('App\ResumeEntry');
    }
}
