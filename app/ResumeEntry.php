<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeEntry extends Model
{
    protected $fillable = ['title', 'start_date', 'end_date', 'description'];
    //

    /**
     * Get the tasks for the resume entry.
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withTimestamps();
    }
}
