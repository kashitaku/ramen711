<?php

namespace app\Http\Controllers\Auth;

use app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use app\User; use Auth; use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	/**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider() {
        return Socialite::driver('twitter')->redirect(); 
	}
	public function handleProviderCallback() {
		try {
			$twitterUser = Socialite::driver('twitter')->user();
		  } catch (Exception $e) {
			return redirect('auth/twitter');
		}
		$authUser = $this->findOrCreateUser($twitterUser);
		Auth::login($authUser, true);
		return redirect()->route('shop.index');
	}
	private function findOrCreateUser($twitterUser) {
		$authUser = User::where('twitter_id', $twitterUser->id)->first();

		if ($authUser){
			return $authUser;
		}

		return User::create([
			'name' => $twitterUser->name,
			'twitter_id' => $twitterUser->id,
			'avatar' => $twitterUser->avatar_original
		]);
	}
}
