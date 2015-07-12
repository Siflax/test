@extends('app')


@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Account</div>

                    <div class="panel-body">

                        <ul class="nav nav-tabs">
                            <li class="{{ Request::is('*subscription-plans*') ? 'active' : '' }} tab"><a href="{{route('subscription-plans.index')}}"><h4>Subscription Plans</h4></a></li>
                            <li class="{{ Request::is('*settings*') ? 'active' : '' }} tab"><a href="{{route('account-settings.index')}}"><h4>Settings</h4></a></li>
                        </ul>


                        @yield('account.content')


                    </div>
                </div>
            </div>

        </div>
    </div>



@stop