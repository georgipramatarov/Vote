<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $fillable = [
    	"cand_id",
    	"numVotes",
    	"Gender",
    	"age"
    ];
}
