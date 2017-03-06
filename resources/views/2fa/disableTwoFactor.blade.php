@extends('admin-home')

@section('disable_2FA')
<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading">2FA Secret Key</div>

                <div class="panel-body">
                    2FA has been removed
                    <br /><br />
                    <a href="{{ url('/admin_home/security') }}">Go Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
