<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elections extends Model
{
    protected $fillable = [
      "election_name",
      "election_desc",
      "num_candidates",
      "close_date",
      "start_date"
    ];
}
