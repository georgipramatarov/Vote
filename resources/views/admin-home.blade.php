@extends('layouts.app')

@section('content')
<div class="container col-md-3 col-md-offset-0">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#428BCA; color: white;"> Admin Dashboard</div>

              <!-- Admins -->
              <form class="test">
                <a href="{{ url('admin_home/overview') }}" style="text-decoration:none;color: inherit;">
                  <div class="panel-body">Admins</div>
                </a>
              </form>
            
            <!-- Security -->
            <form class="test">
              <a href="{{ url('admin_home/security') }}" style="text-decoration:none;color: inherit;">
                <div class="panel-body">Security</div>
              </a>  
            </form>
            
            <!-- Elections -->
            <form class="test">
              <a href="{{ url('admin_home/election') }}" style="display: block; text-decoration:none;color: inherit;">
                <div class="panel-body ">Elections</div>
              </a>
            </form>

            <!-- Overview -->
            <form class="test">
              <a href="{{ url('admin_home/votecodes') }}" style="text-decoration:none;color: inherit;">
                <div class="panel-body">Voting Authentication Codes</div>
              </a>
            </form>
            
            <!-- Polling Cards -->
            <form class="test">
              <a href="{{ url('admin_home/pollingcards') }}" style="display: block; text-decoration:none;color: inherit;">
                <div class="panel-body">Polling Cards</div>
              </a>
            </form>
              



            </div>
        </div>
</div>


@endsection
