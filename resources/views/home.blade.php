@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <pre>
                        <?php 
                            echo Session::get('id');
                            echo "<br>";
                            echo Session::get('name');
                            echo "<br>";
                            echo Session::get('email');
                        ?>

                    </pre>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
