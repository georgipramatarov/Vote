<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
	public function index()
	{
		$cands = \App\Candidate::all();
		return view('candidates', compact('cands'));
	}
}
