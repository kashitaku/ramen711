<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
   public function shops() {
      return $this->belongsToMany('app\Shop');
   }
}
