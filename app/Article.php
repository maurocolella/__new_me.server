<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = ['title', 'slug', 'body'];

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
