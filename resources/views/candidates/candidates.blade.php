<html>
@include('head')
<title>Online Voting System</title>

<link rel="stylesheet" href="style.css" media="all" />

</head>

<body>
@section('content')
<h1><br/>Candidate Information <img src="padlock.png" height="50"><br/><br/></h1>


<table style="width:50%" align=center>
@foreach ($cands as $cand)

   	<td>
    <td>{{ $cand->id }}</td>;

    <td>{{ $cand->name }}</td>;

    <td>{{ $cands->info }}</td>;

    <td> <img src={{$cand->cand_img}} height="120" width="120"><td/>;
 @endforeach
    <!--
    this bit still dont know whats going on, need to consult lauren
    <td> <a href="details.<php? ID=" . $row['ID'];?> . "" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> More Details</a>
    echo "<tr/>"";
    -->

</table>
@endsection
</body>
</html>
