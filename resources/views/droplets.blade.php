@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if( session('message') )
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if( session('error') )
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">My Droplets</div>

                <div class="panel-body">
                    <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>-</th>
                                        
                                    </thead>
                                    <tbody>
                                        @foreach( $droplets as $droplet )
                                        <tr>
                                            <td> {{ $droplet->id }}</td>
                                            <td> {{ $droplet->name }}</td>
                                            <td><a href="../destroy/{{ $droplet->doid }}"><i class="fa fa-close"></i></td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection