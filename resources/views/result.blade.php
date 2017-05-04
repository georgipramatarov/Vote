@extends('admin-home')

@section('charts')


<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Charts</div>

                <div class="panel-body">
                <legend>Statistics:</legend>

                <!-- Winner -->
                <?php
                	$winnerID = DB::table('votes')->select('cand_id', DB::raw('count(*) as total'))
                 		->groupBy('cand_id')->orderBy('total', 'desc')->first()->cand_id;
                 	$winner = DB::table('candidates')->where('id', $winnerID)->first();
                ?>
                <table width="70%"> 
                	<tr>
                		<td width="40%"><h3>Leader:</h3></td>
                		<td width="60%"><h3> {{ $winner->name }}, {{$winner->political_party}}  </h3></td>
                	</tr>
                </table>
                </br>

                <!-- total votes -->
                <table width="50%"> 
                	<tr>
                		<td><h4>Total Votes Cast:</h4></td>
                		<td><h4> {{ DB::table('votes')->count() }} </h4></td>
                	</tr>
                </table>
                </br>


                <!-- Total votes For each candidate -->
                <?php
                	$results = \DB::table('votes')->select(DB::raw('count(cand_id) as count, cand_id as cand_id'))
                		->groupBy('cand_id')->get(); 
                        ?>

                	<table border='0' width="90%">
                	<tr>
                		<th colspan="3"><h4>Vote breakdown for each candidate:</h4></th>
                	</tr>
                	<tr>
                		<th>Candidate</th>
                		<th>Party</th>
                		<th>Total Votes</th>
                        <th></th>
                        <th></th>
                	</tr>

                	@foreach ($results as $res)
                	<?php 
                		$cand = \DB::table('candidates')
                			->where('id',$res->cand_id)->first();
                	?>
                	<tr>
                		<td>{{ $cand->name }} </td>
                		<td> {{ $cand->political_party }} </td>
                  		<td>{{ $res->count }}</td>
                        <td></td>
                        <td></td>
                  	</tr>
                	@endforeach

                	</table>


                    <!-- Charts -->

                <legend style="margin-top:1em;">Charts:</legend>
                {!! $chartAge->render() !!}
                {!! $chartCounty->render() !!}
                {!! $chartGender->render() !!}
			
			</div>
		</div>
</div>
@endsection
