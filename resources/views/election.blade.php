@extends('admin-home')

@section('election-home')
<div class="container col-md-3 col-md-offset-0">
        <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-body">
                  <a href="{{ url('admin_home/create-election') }}" style="text-decoration:none;color: inherit;">+ create new</a>
                </div>
              </div>
            </div>
          </div>
@endsection
