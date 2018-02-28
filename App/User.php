<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	public $table = "users";
	public $fillable = [
		'id',
		'username',
		'avatar_url'
	];
	protected $keyType = 'string';

	public $incrementing = false;

	public function posts()
	{
		return $this->hasMany(Post::class);
	}
}