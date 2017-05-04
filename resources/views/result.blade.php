@extends('admin-home')

@section('charts')


<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Charts</div>

                {!! $chart->render() !!}
                {!! $chartGender->render() !!}

            </div>
      </div>
@endsection
