@extends('admin-home')

@section('security')


<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:lightgray">Voting Authentication Codes</div>
            
            <div class="panel-body">
            
            From here you can generate Voting Authentication Codes (VAC)

            <form id="genVACs" method="POST" action="{{ url('NOTDONEYET') }}">
                <div class="form-group" style="padding-left:1em; padding-top: 1em;">
             
                	<button type="submit" DISABLED class="btn btn-primary">Generate VACs</button>
                
                	<span class="help-block"><span class="text-danger">
                	Warning: If you generate new VACs the previous ones will become invalid and you will need to resend polling cards to users.
                	</span></span>

                </div>
            
            </form>

            

        </div>

    </div>

</div>

@endsection
