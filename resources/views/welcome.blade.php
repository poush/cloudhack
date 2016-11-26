<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deploy To DO</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                  <form>
                <div class="form-group">
                <label for="exampleInputEmail1">Enter Github URL</label>
                </div>
                </form>
                <form>
                        <div class="input-group" >
                        <input id="msg" type="text" class="form-control" name="msg" placeholder=" Enter URL" class="col-xs-8 col-xs-offset-2">
                        </div>
                </form>
                <br>
                <br>


                    <!-- <form>
                        <div class="form-control">
                            <label for="inputurl">Enter URL To GITHUB Repository</label>
                            <input type="url" class="form-control" id="inputurl" aria-describedby="emailHelp" placeholder="Enter URL">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                    </form>
 -->                    <button type="button" class="btn btn-info btn-lg btn-primary"> Create My DO </button>
                    <br>
                    <br>
                    <form>
                        <div class="input-group">
                         <input id="msg" type="text" class="form-control" name="msg" placeholder="" readonly>
                        </div>
                    </form>
                    <br>
                     <br>
                    <div class="links">
                    <a href="">Documentation</a>
                    <a href="https://github.com/poush/cloudhack">GitHub</a>
                    </div>
                </div>
            
        </div>
    </body>
</html>
