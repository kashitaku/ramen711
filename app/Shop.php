<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use app\Like;

class shop extends Model {
	use SoftDeletes;
	protected $guarded = array('id');
	public static $rules = array(
		'name' => 'required',
		'station1' => 'required',
		'type1' => 'required',
		'point' => 'required',
		'URL' => 'required|url',
		'image_url' => 'file|image|mimes:jpeg,jpg,png',
	);
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function likes() {
		return $this->hasMany('app\Like');
	}
	public function like_by() {
		return Like::where('user_id', Auth::user()->id)->first();
	}
}
