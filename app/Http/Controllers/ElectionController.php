<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Elections;
use App\Candidate;

class ElectionController extends Controller
{
   	function create()
   	{
   		return view("create-election");
   	}
   	function store(Request $request)
   	{
   		Elections::create([
   			"election_name" => request("election_name"),
   			"election_desc" => request("election_desc"),
   			"num_candidates" => request("num_candidates"),
   			"start_date" => request("start_date"),
   			"close_date" => request("close_date")
   		]);
   		$num_cands = request("num_candidates");
   		$el_id = \DB::table("elections")->orderBy("created_at","desc")->first()->id;
   		for ($i=0; $i < $num_cands; $i++) {
   			$j = $i + 1;

   			Candidate::create([
   				"name" => $request->cand_name[1],
   				"political_party" => $request->cand_pparty[1],
   				"info" => $request->cand_desc[1],
   				"img" => $request->cand_img[1],
   				"election_id" => $el_id,
   			]);
   		}
   	}
}
