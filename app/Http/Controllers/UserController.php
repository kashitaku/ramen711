<?php

namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\User;
use app\Like;
use app\Shop;
use app\Review;
use Auth;

class UserController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}
	public function index(Request $request) {
		$query = User::query();
		$users = $query->paginate(12);
		return view('user.index')
			->with('users', $users);
	}
	public function detail(Request $request, $id) {
		$user = User::findOrFail($id);
		if($user->image_url) {
			$user->image_url = str_replace('public/', 'storage/', $user->image_url);
		}
		$query = Shop::query();
		$query->join('likes', 'shops.id', '=', 'likes.shop_id')->where('likes.user_id', $request->id)->get();
		$shops = $query->paginate(8, ["*"], 'shoppage')
					->appends($request->only(['reviewpage']));
		$query2 = Review::query();
		$query2->join('shops', 'shop_id', '=', 'shops.id')->where('user_id', $id)->first();
		$reviews = $query2->paginate(8 , ["*"], 'reviewpage')
					->appends($request->only(['shoppage']));
		return view('user.detail')
			->with('user', $user)
			->with('shops', $shops)
			->with('reviews', $reviews);
	}
	public function edit(Request $request) {
		$user = user::find($request->user()->id);
		if($user->image_url) {
			$user->image_url = str_replace('public/', 'storage/', $user->image_url);
		}
		return view('user.edit', ['user'=>$user]);
	}
	public function update(Request $request, $id) {
		$this->validate($request, user::$rules_update);
		$user = user::find($request->user()->id);
			if($request->has('image_url')){
				$user->comment = $request->comment;
				$user->image_url = $request->image_url->storeAs('public/user_images', rand());
				$user->save();
			} else {
				$user->comment = $request->comment;
				$user->save();
			}
		return redirect()->route('user.index');
	}
}
