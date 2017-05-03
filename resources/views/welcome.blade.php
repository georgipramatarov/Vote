<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Secure Vote</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

           
            .subTitle{
				font-size: 40px;
			}
			.subsubTitle{
			12px;
			margin-bottom: 30px;}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Secure Vote
                </div>
                <div class="subTitle">
					Your vote matters!
				</div>
				<div class="subsubTitle">
					This is UK parliamentary general elections. Find out everything you need to know about voting in the UK.
				</div>
                @if (Route::has('login'))
                    <div class="links">
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/vote') }}">Cast Vote</a>
                            <a href="{{ url('/register') }}">Register to Vote</a>
                            <a href="{{ url('/candidates') }}">View all Candidates</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
