<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encrypt;

class ElectoralRoll extends Model
{
  use Encrypt;
    protected $table = "electoral_roll";
    protected $fillable = [
    	"id",
    	"first_name",
      "last_name",
    	"dob",
    	"gender",
      "address",
      "city",
      "county",
      "post_code",
      "email",
      "nino",
      "vac",
      "voted"
    ];
}
