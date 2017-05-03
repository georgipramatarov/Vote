@extends('layouts.app')
@section('content')
<div class="col-md-0 " style="width:50%; margin:auto;">

  <p1>
   <form class="form-horizontal" method="post" action="\">
     <!-- {{csrf_field()}} -->
    <fieldset>


      <!-- Form Name -->
      <legend style="text-align: center;">{{ $election->election_name }}</legend>
      <div class="help-text" style="text-align: center;">Voting Deadline: {{ $election->close_date }} 23:59
      <br>{{ Carbon\Carbon::parse($election->close_date)->diffForHumans()}}</div>
      <br>
      
      <table border="1" align="center">
      <!-- loop through candidates -->
      @foreach ($cands as $cand)
      	<tr>
      	<td > {{ $cand->name }} </td>
        <td> {{ $cand->political_party }} </td>
        <td> 
          @if ( $cand->img ) 
          {{ $path = "imgs/" . $cand->img }}

            <img src="{{ $path }}">
          @else
            <img src="imgs/placeholder.png">
          @endif
        </td>
        <td><button disabled class="btn btn-primary">Vote</button></td>
      	</tr>
      @endforeach

<!-- Voter demo 
  $voter->dob
  $voter->gender
-->
      </table>
    </fieldset>
   </form>
  </p1>
  </div>
@endsection
