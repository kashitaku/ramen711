<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Like;
use Auth;
use app\Shop;

class LikesController extends Controller {
	public function store(Request $requesr, $shopId) {
		Like::create(
			array(
				'user_id' => Auth::user()->id,
				'shop_id' => $shopId
			)
		);
	$shop = Shop::findOrFail($shopId);
	return redirect()
		->action('ShopController@detail', $shop->id);
	}
	public function destroy($shopId, $likeId) {
		$shop = Shop::findOrFail($shopId);
		$shop->like_by()->findOrFail($likeId)->delete();
		return redirect()
		->action('ShopController@detail', $shop->id);
	}
}
