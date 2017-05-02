<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = "candidates";
    protected $fillable = [
    "name",
    "political_party" ,
    "info" ,
    "img",
    "electionID"
  ];
}
