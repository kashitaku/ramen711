<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model {
   use SoftDeletes;
   protected $dates = ['deleted_at'];
   public static $rules = [
         'title' => 'required|max:30',
         'review' => 'required|max:140',
	];
   public function shop() {
      return $this->belongsTo(Shop::class);
   }
}
