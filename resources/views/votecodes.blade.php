@extends('admin-home')

@section('security')

<!-- Confirmation box -->
@if (isset($_SESSION['codesCreated']) && $_SESSION['codesCreated']==1)
    <Script>alert("Voting Authentication Codes successfully created")</Script>
    <?php unset($_SESSION['codesCreated']) ?>
@endif

<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:lightgray">Voting Authentication Codes</div>
            
            <div class="panel-body">
            
            From here you can generate Voting Authentication Codes (VAC)

            <form id="genVACs" action="{{ url('admin_home/vac/generate') }}">
                <div class="form-group" style="padding-left:1em; padding-top: 1em;">
             
                	
                
                	<span class="help-block"><span class="text-danger">
                	Warning: If you generate new VACs the previous ones will become invalid and you will need to resend polling cards to users.
                	</span></span>

                    <span class="help-block"><span class="text-warning">
                    Note: This process will take a few seconds depending on the size of the electoral roll.
                    </span></span>

                    <button type="submit" class="btn btn-primary">Generate VACs</button>

                </div>
            
            </form>

            

        </div>

    </div>

</div>

@endsection
