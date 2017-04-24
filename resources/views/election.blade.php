@extends('admin-home')

@section('election-home')


<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
        <div class="panel panel-default">
    		<div class="panel-heading" style="background-color:lightgray">Elections</div>
    		<div class="panel-body">

    			<a class="btn btn-primary" role="button" href="{{ url('admin_home/create-election') }}">Create New</a>
    		</div>


		</div>
	</div>
</div>

@endsection
