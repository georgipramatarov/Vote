<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class adminInfo extends Model
{
    //
    use Notifiable;
    protected $table = 'admin_users';
}
