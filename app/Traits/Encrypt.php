<?php
namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encrypt {

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable) && ( ! is_null($value)))
        {
            $value = Crypt::decrypt($value);
        }

        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable))
        {
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }
}
