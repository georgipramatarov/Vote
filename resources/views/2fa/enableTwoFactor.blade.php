@extends('admin-home')

@section('enable_2FA')
<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading">2FA Secret Key</div>

                <div class="panel-body">
                    Open up your 2FA mobile app and scan the following QR barcode:
                    <br />
                    <img alt="Image of QR barcode" src="{{ $image }}" />

                    <br />
                    If your 2FA mobile app does not support QR barcodes,
                    enter in the following number: <code>{{ $secret }}</code>
                    <br /><br />
                    <a href="{{ url('/admin_home/security') }}">Go Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
