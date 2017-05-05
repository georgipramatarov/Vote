<?php
//Reference:
//Tutorial used for the admin 2fa
//www.sitepoint.com. (2016). 2FA in Laravel with Google Authenticator. [online] Available at: https://www.sitepoint.com/2fa-in-laravel-with-google-authenticator-get-secure/ [Accessed 17 Feb. 2017].


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogle2faSecretToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function ($table) {
            $table->string('google2fa_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function ($table) {
            $table->dropColumn('google2fa_secret');
        });
    }
}
