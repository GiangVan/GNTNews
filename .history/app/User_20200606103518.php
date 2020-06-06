<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends

Model implements
	\Illuminate\Contracts\Auth\Authenticatable
{
	// protected $table = 'account';
}
