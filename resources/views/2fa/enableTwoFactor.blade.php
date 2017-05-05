{{--
  //Reference:
//Tutorial used for the admin 2fa
//www.sitepoint.com. (2016). 2FA in Laravel with Google Authenticator. [online] Available at: https://www.sitepoint.com/2fa-in-laravel-with-google-authenticator-get-secure/ [Accessed 17 Feb. 2017].
--}}

@extends('admin-home')

@section('enable_2FA')
<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading">Secret key</div>

                <div class="panel-body">
                    Scan the barcode bolow:
                    <br />
                    <img alt="Image of QR barcode" src="{{ $image }}" />

                    <br />
                    If your mobile device does not have support for QR barcodes,
                    enter the following number: <code>{{ $secret }}</code>
                    <br /><br />
                    <a href="{{ url('/admin_home/security') }}">Go Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
