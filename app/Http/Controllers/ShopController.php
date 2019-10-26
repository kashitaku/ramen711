<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\Shop;
use app\User;
use app\Like;
use app\Review;
use Auth;

class ShopController extends Controller {
   public function __construct() {
		$this->middleware('auth', array('except' => 'index'));
	}
	public function index(Request $request) {
		$keyword = $request->input('keyword');
		$keyword_station = $request->input('keyword_station');
		$sort = $request->sort;
		$query = Shop::query();
		if ($keyword || $keyword_station || $sort) {
			if ($keyword) {
				$query->where('name', 'like', '%'.$keyword.'%')->get();
			}
			if ($keyword_station) {
				$query->where('name', 'like', '%'.$keyword_station.'%')->get();
			}
			if ($sort) {
				$query->orderBy('likes_count', 'Desc')->get();
			}
		}
			$shops = $query->paginate(8)
				->appends($request->only(['keyword', 'keyword_station', 'sort']));
		return view('shop.index')
			->with('keyword', $keyword)
			->with('keyword_station', $keyword_station)
			->with('sort', $sort)
			->with('shops', $shops);
	}
	public function detail(Request $request, $id) {
		$shop = Shop::findOrFail($id);
		$like = $shop->likes()->where('user_id', Auth::user()->id)->first();
      $reviews = Review::where('shop_id', $id)->join('users', 'users.id', '=', 'reviews.user_id')->get();
		if($shop->image_url) {
			$shop->image_url = str_replace('public/', 'storage/', $shop->image_url);
		}
		return view('shop.detail')
       ->with('shop', $shop)
       ->with('like',  $like)
       ->with('reviews',  $reviews);
  }
}
