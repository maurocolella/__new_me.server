<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['title', 'rating'];

    /**
     * Get related skills.
     */
    public function related_to()
    {
        return $this->belongsToMany('App\Skill', null, 'skill_id', 'related_id')->withTimestamps();
    }

    /**
     * Get related skills.
     */
    public function related_from()
    {
        return $this->belongsToMany('App\Skill', null, 'related_id', 'skill_id')->withTimestamps();
    }

    /**
     * Get related works.
     */
    public function works()
    {
        return $this->belongsToMany('App\Work', 'work_skill')->withTimestamps();
    }
}
