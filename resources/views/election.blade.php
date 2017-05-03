@extends('admin-home')

@section('election-home')


<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
        <div class="panel panel-default">
    		<div class="panel-heading" style="background-color:lightgray">Current Elections</div>
    		<div class="panel-body">  

    		@if (sizeof($elections) > 0)
    		  <strong>
    			<div class="panel-body col-md-4">Name</div>
                <div class="panel-body col-md-3">Starts</div>
                <div class="panel-body col-md-2">Ends</div>
                <div class="panel-body col-md-1">Options</div>

              </strong>
    		@endif

    		@foreach ($elections as $elec)
                  <div class="panel-body col-md-4">{{ $elec->election_name }} </div>
                  <div class="panel-body col-md-3">{{ Carbon\Carbon::parse($elec->start_date)->diffForHumans()}} </div>
                  <div class="panel-body col-md-2"> {{ $elec->close_date }} </div>

                  <!-- buttons -->
                  <div class="panel-body col-md-2">
                  <div class="btn-group">
                  	<!-- Edit -->
                  	<a href="#" class="btn btn-primary btn-sm">
          				Edit
			        </a>

			       <!-- delete -->
			        <a href="#" class="btn btn-danger btn-sm">
          				Delete
			        </a>
			        </div>
                  </div>

    		@endforeach

    		<!-- new election button -->
    			<div class="col-md-12" style="margin-bottom: 1em; margin-top: 1em; text-align: right">
    				<a class="btn btn-success" role="button" href="{{ url('admin_home/create-election') }}">Create New</a>
    			</div>

    		</div>


		</div>
	</div>
</div>

@endsection
