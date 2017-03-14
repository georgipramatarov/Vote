<html>
@extends('layouts.app')
<link href="css/add.css" rel=stylesheet>
@section('content')
<h1><br/>Candidate Information <br/><br/></h1>

<table id="candidates" align=center>
	@foreach ($cands as $cand)
	    <tr class="candidate">
		    <th>{{ $cand->name }}</th>
		</tr>
		<tr>
		    <td>
		    	@if (strlen($cand->info) > 100)
		    		{{ substr($cand->info, 0, 100) . " ..." }}
		    	@else
		    		{{ $cand->info }}
		    	@endif
		    </td>

		    <td><img src = {{$cand->img}} height="120" width="120"><td/>
		</tr>
	 @endforeach
    <!--
    this bit still dont know whats going on, need to consult lauren
    <td> <a href="details.<php? ID=" . $row['ID'];?> . "" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> More Details</a>
    echo "<tr/>"";
    -->

</table>
@endsection
</html>
