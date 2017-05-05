{{--
  //Reference:
//Tutorial used for the admin 2fa
//www.sitepoint.com. (2016). 2FA in Laravel with Google Authenticator. [online] Available at: https://www.sitepoint.com/2fa-in-laravel-with-google-authenticator-get-secure/ [Accessed 17 Feb. 2017].
--}}

@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/2fa/validate">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('totp') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Enter Code:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="totp">

                                @if ($errors->has('totp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-mobile"></i>Validate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
