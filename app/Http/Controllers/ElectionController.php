<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElectionController extends Controller
{
   	function create() 
   	{
   		return view('create-election');
   	}
}
