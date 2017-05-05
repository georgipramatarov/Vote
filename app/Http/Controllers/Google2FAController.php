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
    public function enable(Request $request)
    {
      //generate secret using the constant time encoding
        $secret2FA = $this->generateSecret();
        //gets the user object that is currently logged in the system
        $admin_user = $request->user();
        // encrypts the secret google 2fa and then stores it into the table
        $admin_user->google2fa_secret = Crypt::encrypt($secret2FA);
        // save the canges to the database
        $admin_user->save();
        //uses the google2fa library to generate the QR code needed for the Google Authenticator application
        // encodes admin email, secret that was generates
        $QR = Google2FA::getQRCodeGoogleUrl(
            $request->getHttpHost(),
            $admin_user->email,
            $secret2FA,
            200
        );
        //returns the view and passes the Qr code as a parameter
        return view('2fa/enableTwoFactor', ['image' => $QR,
            'secret' => $secret2FA]);
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request)
    {
      //gets the current admin logged in
        $admin_user = $request->user();
        //sets the google2fa field in the table to null, to remove the 2fa secret
        $admin_user->google2fa_secret = null;
        // saves the changes to the table
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
      //constant time encoder is used to generate the secret base32 key
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }
}
