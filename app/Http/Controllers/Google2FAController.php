<?php
//Reference:
//Tutorial used for the admin 2fa
//www.sitepoint.com. (2016). 2FA in Laravel with Google Authenticator. [online] Available at: https://www.sitepoint.com/2fa-in-laravel-with-google-authenticator-get-secure/ [Accessed 17 Feb. 2017].



namespace App\Http\Controllers;

use Auth;
use Crypt;
use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \ParagonIE\ConstantTime\Base32;

class Google2FAController extends Controller
{
    use ValidatesRequests;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin_user');
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function enableTwoFactor(Request $request)
    {
        $secret2FA = $this->generateSecret();
        $admin_user = $request->user();
        $admin_user->google2fa_secret = Crypt::encrypt($secret2FA);
        $admin_user->save();

        $QR = Google2FA::getQRCodeGoogleUrl(
            $request->getHttpHost(),
            $admin_user->email,
            $secret2FA,
            200
        );

        return view('2fa/enableTwoFactor', ['image' => $QR,
            'secret' => $secret2FA]);
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor(Request $request)
    {
        $admin_user = $request->user();

        $admin_user->google2fa_secret = null;
        $admin_user->save();

        return view('2fa/disableTwoFactor');
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }
}
