<?php

namespace app;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use app\Shop;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
		'id', 'role', 'remember_token', 'created_at', 'updated_at',
    ];
    protected $fillable = [
		'name', 'email', 'password', 'twitter_id', 'avatar',
    ];

	public static $rules = [
		'name' => 'required',
		'email' => 'required', 'email',
		'password' => 'required', 
	];

	public static $rules_update = [
		'image_url' => 'file|image|mimes:jpeg,jpg,png',
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	public function likes() {
		return $this->hasMany(Like::class);
	}
	public function User() {
		return $this->belongsToMany('app\shop', 'likes');
	}
}
