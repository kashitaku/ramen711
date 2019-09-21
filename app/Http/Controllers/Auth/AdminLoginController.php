<?php
namespace app\Http\Controllers\Auth;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use Auth;


class AdminLoginController extends Controller {
	public function __construct() {
		$this->middleware('guest:admin')->except('logout');
	}
	public function guard() {
		return Auth::guard('admin');
	}
	public function showLoginForm() {
		return view('auth.admin.login');
	}
	public function login(Request $request) {
		// Attempt to log the user in
		if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->intended(route('admin.index'));
		}
		// if unsuccessful, then redirect back to the login with the form data
		return redirect()->back()->withInput($request->only('email', 'remember'));
	}
	public function logout(Request $request) {
		$this->guard('admin')->logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect()->route('admin.login');
	}
}
