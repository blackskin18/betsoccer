<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
                background-size: cover;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body background= {{ asset('/img/background.jpg') }}>
        <div class="flex-center position-ref"  style="background-color: red">
            @if (Route::has('login'))
                <div class="top-right links" >
                    @if (Auth::check())
                        <a href="{{ url('/home') }}" style="color: red; font-size: 20px">Home</a>
                    @else
                        <a href="{{ url('/login') }}" style="color: red; font-weight: bold; font-size: 20px;">Login</a>
                        <a href="{{ url('/register') }}" style="color: red; font-weight: bold;font-size: 20px">Register</a>
                    @endif
                </div>
            @endif
        </div> 
        <div class="content">
            <div style="font-size: 50px; font-weight: bold;text-shadow: white 2px -1px 3px; color: black; margin-top: 275px ">
                <h1"> Welcome to BetSoccer.com </h1>
            </div>
        </div>
    </body>
</html>
