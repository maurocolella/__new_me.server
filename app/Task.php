<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['description'];
    //
    public function resumeentries()
    {
        return $this->belongsToMany('App\ResumeEntry')->withTimestamps();
    }

    public function works()
    {
        return $this->belongsToMany('App\Work', 'work_task')->withTimestamps();
    }
}
