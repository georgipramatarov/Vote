@extends('admin-home')

@section('overview')

<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Current Admins</div>



                  @foreach ($admin_users as $admin_user)
                  @if(Auth::guard('admin_user')->user()->name != $admin_user->name)
                  <div class="panel-body">{{ $admin_user->email}} </div>
                  @endif
                  @endforeach


            </div>
      </div>
</div>

@endsection
