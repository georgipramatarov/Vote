@extends('layouts.app')

@section('content')
<div class="container col-md-3 col-md-offset-0">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"> Admin Dashboard</div>

                <div class="panel-body">
                    <a class = "nav-bar-mouseover" href="http://127.0.0.1:8000/admin_home"> Overview</a>
                </div>
                <form>
                  {{csrf_field()}}
                <div class="panel-body">
                  <a href="{{ url('admin_home/security') }}" class="test">Security</a>
                </div>
              </form>
                <div class="panel-body">
                    Current Votes
                </div>
            </div>
        </div>
</div>
@endsection
