<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;

class CandidateController extends Controller
{
	public function index()
	{
		$cands = \App\Candidate::all();
		return view('candidates', compact('cands'));
	}
	public function detail(Candidate $cand)
	{
		return view('details', $cand);
	}
}
