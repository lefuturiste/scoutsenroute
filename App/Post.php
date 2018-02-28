<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	public $table = "posts";

	protected $keyType = 'string';

	public $incrementing = false;

	public function user(){
		return $this->belongsTo(User::class);
	}
}