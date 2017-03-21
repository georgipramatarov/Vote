@extends('admin-home')

@section('overview')

<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Current Admins</div>



                  @foreach ($admin_users as $admin_user)
                  @if(Auth::guard('admin_user')->user()->name != $admin_user->name && $admin_user->authorize !=0 )
                  <div class="panel-body">{{ $admin_user->email}} </div>
                  @endif
                  @endforeach


            </div>
      </div>
</div>

<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Admins Awaiting Approval</div>



                  @foreach ($admin_users as $admin_user)
                  @if($admin_user->authorize !=1)
                  <div class="panel-body col-md-7">{{ $admin_user->email}} </div>
                  <div class="panel-body col-md-3"> Requested: {{ Carbon\Carbon::parse($admin_user->created_at)->diffForHumans()}} </div>
                  <form method="post" >
                    {{csrf_field()}}
                  <div class="panel-body">
                    <button type="submit" class="btn btn-primary">
                        Deny
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Grant
                    </button>
                  </div>
                </form>
                  @endif
                  @endforeach

            </div>
      </div>
</div>

@endsection
