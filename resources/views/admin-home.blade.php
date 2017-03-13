@extends('layouts.app')

@section('content')
<div class="container col-md-3 col-md-offset-0">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray"> Admin Dashboard</div>
                <form class="test">
                <div class="panel-body">
                    <a href="{{ url('admin_home/overview') }}" style="text-decoration:none;color: inherit;"> Overview</a>
                </div>
              </form>
                <form class="test">
                <div class="panel-body">
                  <a href="{{ url('admin_home/security') }}" style="text-decoration:none;color: inherit;">Security</a>
                </div>
              </form>
              <form class="test">
              <div class="panel-body">
                  Create Election
              </div>
            </form>
            <form class="test">
                <div class="panel-body">
                    Current Elections
                </div>
              </form>
                  <form class="test">
                <div class="panel-body">
                    Inbox
                </div>
              </form>
                  <form class="test">
                <div class="panel-body">
                    Calendar
                </div>
              </form>
                  <form class="test">
                <div class="panel-body">
                    Settings
                </div>
              </form>
            </div>
        </div>
</div>


@endsection
