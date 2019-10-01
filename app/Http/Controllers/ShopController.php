<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\Shop;
use Auth;

class ShopController extends Controller {
	public function __construct() {
		$this->middleware('auth', array('except' => 'index'));
	}
	public function index(Request $request) {
		$keyword = $request->input('keyword');
		if (!empty($keyword)) {
			$query = Shop::query();
			$query->where('name', 'like', '%'.$keyword.'%')->orWhere('station1', 'like', '%'.$keyword.'%');
			$shops = $query->paginate(8);
		} else {
			$shops = Shop::paginate(8);
		}
		if (!empty($request->sort)) {
			if ($request->sort == 'likeDesc') {
				$query->Shop::orderBy('likes_count', 'desc')->get(); 
				$shops = $query->paginate(8);
			}
		}
		return view('shop.index', ['shops'=>$shops]);
	}
	public function detail(Request $request, $id) {
		$shop = Shop::findOrFail($id);
		$like = $shop->likes()->where('user_id', Auth::user()->id)->first();
		if($shop->image_url) {
			$shop->image_url = str_replace('public/', 'storage/', $shop->image_url);
		}
		return view('shop.detail', ['shop'=>$shop, 'like' => $like]);
	}
}
