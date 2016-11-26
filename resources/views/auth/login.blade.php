@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <a href="dologin" id="login" class="btn btn-lg btn-block btn-primary">
                        Sign In With Digital Ocean                              
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#login').click(function(){
        $(this).addClass('disabled');
        $(this).html('Redirecting...');
    })
</script>
@endsection
