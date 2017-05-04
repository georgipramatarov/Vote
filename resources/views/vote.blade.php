@extends('layouts.app')
@section('content')

@if (!Session::has('vot'))
  {!! abort(403, 'Unauthorized Action') !!}
@endif
<div class="col-md-0 " style="width:50%; margin:auto;">

  <p1>
  <!-- form -->
   <form class="form-horizontal" method="post" action="\vote_page">
      {{csrf_field()}}
    <fieldset>

    <!-- election name -->
      <legend style="text-align: center;">{{ $election->election_name }}</legend>

      <!-- Deadline -->
      <div class="help-text" style="text-align: center; margin-bottom: 1em;">Voting Deadline: {{ $election->close_date }} 23:59
        <br>{{ Carbon\Carbon::parse($election->close_date)->diffForHumans()}}
      </div>

      <table border="1" align="center">
      <!-- loop through candidates -->
      @foreach ($cands as $cand)
      	<tr>
      	<td > {{ $cand->name }} </td>
        <td> {{ $cand->political_party }} </td>

        <td>
          @if ( $cand->img )
           <img src="{{URL::asset('imgs/' . $cand->img )}}" alt="profile Pic">


          @else
            <img src="imgs/placeholder.png">
          @endif
        </td>

        {{ Form::hidden('cand_id', $cand->id) }}

        <td><button class="btn btn-primary" id="{{ $cand->id }}" value = "1">Vote</button></td>
      	</tr>
      @endforeach


      </table>
    </fieldset>
   </form>
  </p1>
  </div>
@endsection
