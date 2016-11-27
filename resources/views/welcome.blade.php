<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deploy To DO</title>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous">    
        </script>

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
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <!-- <a href="{{ url('/register') }}">Register</a> -->
                </div>
            
            @endif

            <div class="content">
                <div class="title m-b-md">
                Deploy To DO
                </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Github URL</label>
                    </div>

                    <div class="input-group center-block" >
                        <input id="msg" type="text" class="form-control input-lg" name="msg" placeholder=" Enter URL" style="margin-bottom: 20px;"class="col-sm-8 col-sm-offset-6">
                    </div>
 

                <br>
                <br>
                
                <button type="button" id="createdo" class="btn btn-info btn-lg btn-primary"> Create My DO Button </button>
                    <br>
                    <br>
                    <div class="input-group center-block" id="link">
                         <input id="linkto" type="text" class="form-control" style="margin-bottom: 20px;" readonly>
                        <span class="help-block"> Copy and paste it to your readme file</span>
                    </div>


                     <br>
                    <div class="links">
                    <a href="http://ipiyush.com/docu/">Documentation</a>
                    <a href="https://github.com/poush/cloudhack" target="blank">GitHub</a>
                    </div>
                </div>
            
        </div>
        <script type="text/javascript">
            $('#link').hide();

            $('#msg').keyup(function(e){
                data = $('#msg').val();
                post = "[![Deploy to DO](http://67.205.151.140/img/button.png)](http://67.205.151.140/github?url="+ data +")";
                $('#linkto').val(post);
                $('#link').hide();
            })

            $('#createdo').click(function(ev){
                ev.preventDefault();
                $('#link').show();

            })
        </script>
    </body>
</html>
