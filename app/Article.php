<?php

namespace App;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // use Cachable;

    protected $fillable = ['title', 'slug', 'body'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
