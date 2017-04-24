@extends('admin-home')

@section('security')

<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Two-Factor Authentication</div>
                <div class="panel-body">
                    @if (Auth::guard("admin_user")->user()->google2fa_secret)
                    <a href="{{ url('2fa/disable') }}" class="btn btn-warning">Disable</a>
                    @else
                    <a href="{{ url('2fa/enable') }}" class="btn btn-primary" >Enable</a>
                    @endif
            </div>
      </div>
</div>


<div class="col-md-0 ">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgray">Change Password</div>
        <div class="panel-body">
          <form method="POST">
            {{csrf_field()}}
            <label for="1">Old Password: &nbsp</label>
            <input id='1'>
            <br>
            <label for="2">New Password: &nbsp</label>
            <input id='2'>
            <br>
            <label for="3">Confirm Password: &nbsp</label>
            <input id='3'>
            <br>
            <button type="submit" class="btn btn-primary">
                Confirm
            </button>
          </form>
          </div>
      </div>
</div>
</div>

@endsection
