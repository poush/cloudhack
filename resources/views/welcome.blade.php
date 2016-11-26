<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deploy To DO</title>


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
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <!-- <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div> -->
            
            @endif

            <div class="content">
                <div class="title m-b-md">
                Deploy To DO
                </div>
                <div class="links">
                    <a href="">Documentation</a>
                    <a href="https://github.com/poush/cloudhack">GitHub</a>
                </div>
                    <form>
                        <div class="form-control">
                            <label for="inputurl">Enter URL To GITHUB Repository</label>
                            <input type="url" class="form-control" id="inputurl" aria-describedby="emailHelp" placeholder="Enter URL">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                    </form>
                    <button type="button" class="btn btn-info btn-lg">New Button</button>
                    <form>
                        <div class="input-group">
                        <input id="msg" type="text" class="form-control" name="msg" placeholder="" readonly>
                        </div>
                    </form>
                </div>
            
        </div>
    </body>
</html>
