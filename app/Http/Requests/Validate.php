<?php
//Reference:
//Tutorial used for the admin 2fa
//www.sitepoint.com. (2016). 2FA in Laravel with Google Authenticator. [online] Available at: https://www.sitepoint.com/2fa-in-laravel-with-google-authenticator-get-secure/ [Accessed 17 Feb. 2017].


namespace App\Http\Requests;

use Cache;
use Crypt;
use Google2FA;
use App\AdminUser;
use App\Http\Requests\Request;
use Illuminate\Validation\Factory as ValidatonFactory;

class Validate extends Request
{
    /**
     *
     * @var \App\AdminUser
     */
    private $admin_user;

    /**
     * Create a new FormRequest instance.
     *
     * @param \Illuminate\Validation\Factory $factory
     * @return void
     */
    public function __construct(ValidatonFactory $factory)
    {
        $factory->extend(
            'valid',
            function ($attribute, $value, $parameters, $validator) {
              // gets the user that is currently trying to log in and decrypts the secret field
                $secret2FA = Crypt::decrypt($this->user->google2fa_secret);
                // compares and verifies the value that the admin enters to the one we just decrypted
                return Google2FA::verifyKey($secret2FA, $value);
            },
            'Provided token is not valid'
        );

        $factory->extend(
            'used',
            //after the key is used it is stored in the cache and can not be used for the next 4 minutes
            function ($attribute, $value, $parameters, $validator) {
                $key = $this->user->id . ':' . $value;
                // checks whether the key is still present in the cache if it is returns key already used
                return !Cache::has($key);
            },
            'Provided token has already been used! Please try again, with a new one.'
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $this->user = AdminUser::findOrFail(
                session('2fa:user:id')
            );
        } catch (Exception $exc) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'totp' => 'bail|required|digits:6|valid|used',
        ];
    }
}
