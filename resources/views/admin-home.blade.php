@extends('layouts.app')

@section('content')
<div class="container col-md-3 col-md-offset-0">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#428BCA; color: white;"> Admin Dashboard</div>
              
              <!-- Overview -->
              <form class="test">
                <a href="{{ url('admin_home/overview') }}" style="text-decoration:none;color: inherit;">
                  <div class="panel-body">Overview</div>
                </a>
              </form>

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
            
            <!-- Polling Cards -->
            <form class="test">
              <a href="{{ url('admin_home/pollingcards') }}" style="display: block; text-decoration:none;color: inherit;">
                <div class="panel-body">Polling Cards</div>
              </a>
            </form>
              
            <!-- Settings -->
            <form class="test">
              <a href="{{ url('admin_home/#') }}" style="display: block; text-decoration:none;color: inherit;">
                <div class="panel-body">Settings</div>
              </a>
            </form>


            </div>
        </div>
</div>


@endsection
