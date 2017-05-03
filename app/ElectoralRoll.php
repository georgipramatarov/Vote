<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesVoter;

class ElectoralRoll extends Model
{
  use AuthenticatesVoter;
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
