<?php

namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Http\Requests;
use app\User;
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
		return view('user.detail')
			->with('user', $user);
	}
	public function edit(Request $request) {
		$user = user::find($request->id);
		if($user->image_url) {
			$user->image_url = str_replace('public/', 'storage/', $user->image_url);
		}
		return view('user.edit', ['user'=>$user]);
	}
	public function update(Request $request, $id) {
		$this->validate($request, user::$rules_update);
		$user = user::find($request->id);
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