<html>
@extends('layouts.app')
@section('content')
<h1><br/>Candidate Information <br/><br/></h1>


<style type="text/css">
	td {
		padding-left-right:2px;
	}
</style>
<table align=center>
	@foreach ($cands as $cand)
	    <td>{{ $cand->name }}</td>;

	    <td>{{ $cand->info }}</td>;

	    <td><img src = {{$cand->img}} height="120" width="120"><td/>
	 @endforeach
    <!--
    this bit still dont know whats going on, need to consult lauren
    <td> <a href="details.<php? ID=" . $row['ID'];?> . "" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> More Details</a>
    echo "<tr/>"";
    -->

</table>
@endsection
</html>
