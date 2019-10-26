<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use Auth;
use app\User;
use app\Shop;
use app\Review;

class ReviewsController extends Controller {
   public function store(Request $request, $shopId) {
      $this->validate($request, Review::$rules);
      $review = new Review;
      $review->title = $request->title;
      $review->review = $request->review;
      $review->user_id = Auth::user()->id;
      $review->shop_id = $shopId;
      $review->save();
      return redirect()->back();
   }
   public function delete($shopId) {
      Review::where('shop_id', $shopId)->where('user_id', Auth::user()->id)->delete();
      return redirect()->back();
   }
}
