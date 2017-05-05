<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Cache;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Requests\Validate;

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
    protected $redirectTo = '/admin_home/overview';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin-auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin_user');
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/admin_login');
    }

    /**
     * Send the post-authentication response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return \Illuminate\Http\Response
     */
    private function authenticated(Request $request, Authenticatable $user)
    {
      //checks if the admin has set up 2fa if so the admin is sent to the validation page
        if ($user->google2fa_secret) {
            Auth::logout();
            $request->session()->put('2fa:user:id', $user->id);
            return redirect('2fa/validate');
        }
        //if the 2fa is not set the user is redirected to the home page
        return redirect('admin_home/overview');
    }

    /**
    *
    * @return \Illuminate\Http\Response
    */
   public function getValidateToken()
   {
     //function is used to display the validation field for the one time password if the user id is set

       //if use id is set in the session the user is sent to the validation page
       if (session('2fa:user:id')) {
           return view('2fa/validate');
       }
       //if not the user is sent to the login page
       return redirect('admin_login');
   }

   /**
 *
 * @param  App\Http\Requests\Validate $request
 * @return \Illuminate\Http\Response
 */
public function postValidateToken(Validate $request)
{
    //get user id and create cache key
    $userId = $request->session()->pull('2fa:user:id');
    $key    = $userId . ':' . $request->totp;
    //adds the key to the cache in order to restrict using the same key more than once in a time frame of 4 minutes
    Cache::add($key, true, 4);
    //use auth to log in user
    Auth::loginUsingId($userId);
    return redirect()->intended($this->redirectTo);
}

}
