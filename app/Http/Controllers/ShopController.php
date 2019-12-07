<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\Shop;
use app\User;
use app\Like;
use app\Tag;
use app\Review;
use Auth;

class ShopController extends Controller {
   public function __construct() {
		$this->middleware('auth', array('except' => 'index'));
	}
	public function index(Request $request) {
		$keyword = $request->input('keyword');
		$keyword_station = $request->input('keyword_station');
		$sort1 = $request->sort1;
		$sort2 = $request->sort2;
		$query = Shop::query();
		$tags = Tag::all();
			if ($keyword) {
				$query->where('name', 'like', '%'.$keyword.'%')->get();
			}
			if ($keyword_station) {
				$query->where('name', 'like', '%'.$keyword_station.'%')->get();
			}
			if ($request->has('sort1') && $sort1 !== ('指定なし')) {
            $query ->select(['shops.id', 'shops.name', 'shops.station1', 'shops.point', 'shops.url', 'shops.created_at'])
               ->where('shop_tag.tag_id', $sort1)->join('shop_tag', 'shops.id', '=', 'shop_tag.shop_id');
			}
			if ($request->has('sort2') && $sort2 !== ('指定なし')) {
            if ($sort2 == 'likeDesc') {
               $query->orderBy('likes_count', 'Desc')->get();
            } elseif ($sort2 == 'dateDesc') {
               $query->orderBy('updated_at', 'Desc')->get();
            } 
         }
		$shops = $query->paginate(8)
			->appends($request->only(['keyword', 'keyword_station', 'sort1', 'sort2']));
		return view('shop.index')
			->with('keyword', $keyword)
			->with('keyword_station', $keyword_station)
			->with('sort1', $sort1)
			->with('sort2', $sort2)
			->with('shops', $shops)
			->with('tags', $tags);
	}
	public function detail(Request $request, $id) {
		$shop = Shop::findOrFail($id);
		$like = $shop->likes()->where('user_id', Auth::user()->id)->first();
		$reviews = Review::select(['reviews.id', 'reviews.user_id', 'reviews.shop_id', 'reviews.title', 'reviews.review', 'reviews.created_at', 'users.name', 'users.image_url' ])
         ->where('shop_id', $id)->join('users', 'users.id', '=', 'reviews.user_id')->paginate(8);
		if($shop->image_url) {
			$shop->image_url = str_replace('public/', 'storage/', $shop->image_url);
		}
		return view('shop.detail')
		   ->with('shop', $shop)
		   ->with('like',  $like)
		   ->with('reviews',  $reviews);
  }
}
