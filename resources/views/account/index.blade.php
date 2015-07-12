@extends('layouts.panel', ['panelHeading' => 'Account'])


@section('panel.content')

        <ul class="nav nav-tabs">
            <li class="{{ Request::is('*subscription-plans*') ? 'active' : '' }} tab"><a href="{{route('subscription-plans.index')}}"><h4>Subscription Plans</h4></a></li>
            <li class="{{ Request::is('*settings*') ? 'active' : '' }} tab"><a href="{{route('account-settings.index')}}"><h4>Settings</h4></a></li>
        </ul>


        @yield('account.content')

@stop