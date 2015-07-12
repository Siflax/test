@extends('account.index')

@section('account.content')


        @if($shopIsSubscribed)
            <p>You are subscribed. Uninstall the app to cancel the subscription.</p>
        @else
            <div class="form-group">

                {!! Form::open([ 'route' => 'subscription-plans.store'])!!}



                <div class="input-group">



            <span class="input-group-btn">
                {!! Form::submit('New Subscription Plan', ['class'=> 'btn btn-primary']) !!}
            </span>

                </div>
                {!! Form::close() !!}
            </div>
        @endif
@stop