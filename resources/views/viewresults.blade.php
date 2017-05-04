@extends('admin-home')

@section('security')


<div class="container col-md-8 col-md-offset-0">
    <div class="col-md-0 ">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:lightgray">Election Results</div>
            
            <div class="panel-body">
            {!! Charts::assets() !!}
            {!! $chart->render() !!}

        </div>

    </div>

</div>


@endsection
