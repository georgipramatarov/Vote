@extends('admin-home')

@section('election-home')


<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
        <div class="panel panel-default">
    		<div class="panel-heading" style="background-color:lightgray">Current Elections</div>
    		<div class="panel-body">

    			@foreach ($elections as $elec)
                  <div class="panel-body col-md-7">{{ $elec->election_name }} </div>
                  <div class="panel-body col-md-3"> Deadline {{ Carbon\Carbon::parse($elec->close_date)->diffForHumans()}} </div>
                  <form method="post">

    			@endforeach

    			<div class="col-md-12" style="margin-bottom: 1em; margin-top: 1em; text-align: right">
    				<a class="btn btn-primary" role="button" href="{{ url('admin_home/create-election') }}">Create New</a>
    			</div>

    		</div>


		</div>
	</div>
</div>

@endsection
