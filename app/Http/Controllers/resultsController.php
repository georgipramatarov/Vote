<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;

class resultsController extends Controller
{
	public function index()
	{
		return view('viewresults');
	}
}
