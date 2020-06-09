<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
