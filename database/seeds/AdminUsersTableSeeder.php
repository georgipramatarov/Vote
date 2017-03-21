<?php

use Illuminate\Database\Seeder;
use App\AdminUser;
class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new AdminUser();
        $user->name = "admin";
        $user->email = "admin@g.com";
        $user->password = crypt("secret", "");
        $user->authorize = true;
        $user->save();

        $user = new AdminUser();
        $user->name = "admin1";
        $user->email = "admin1@g.com";
        $user->password = crypt("secret", "");
        $user->authorize = true;
        $user->save();
    }
}
