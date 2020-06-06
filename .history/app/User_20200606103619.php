<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends

Model implements
	\Illuminate\Contracts\Auth\Authenticatable
{
	// protected $table = 'account';
	public function getAuthIdentifierName();
	public function getAuthIdentifier();
	public function getAuthPassword();
	public function getRememberToken();
	public function setRememberToken($value);
	public function getRememberTokenName();
}
