<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    public function languages()
    {
        return $this->hasMany('App\Language');
    }

    public function certifications()
    {
        return $this->hasMany('App\Certification')->orderBy('id');
    }
}
