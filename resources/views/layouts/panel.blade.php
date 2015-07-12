@extends('app')


@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{$panelHeading}}</div>

                    <div class="panel-body fixed-panel">

                        @yield('panel.content')

                    </div>
                </div>
            </div>

        </div>
    </div>



@stop