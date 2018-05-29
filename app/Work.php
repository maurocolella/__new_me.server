<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['title', 'start_date', 'end_date', 'description'];

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'work_task')->withTimestamps();
    }

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
