@extends('admin-home')

@section('security')

<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Two-Factor Authentication</div>
                <div class="panel-body">
                    @if (Auth::guard("admin_user")->user()->google2fa_secret)
                    <a href="{{ url('2fa/disable') }}" class="btn btn-warning">Disable 2fa</a>
                    @else
                    <a href="{{ url('2fa/enable') }}" class="btn btn-primary" >Enable 2fa</a>
                    @endif
            </div>
      </div>
</div>



</div>

@endsection
