<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{
	
	protected $fillable = ['username','email','password'];

	protected $hidden = ['password','remember_token'];
	
}