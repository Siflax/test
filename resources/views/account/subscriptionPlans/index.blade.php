@extends('account.index')

@section('account.content')


        @if($subscriptionPlan)
            <p>You are subscribed. Uninstall the app to cancel the subscription.</p>

            @if($subscriptionPlan->isOnTrial())
            <p>You trial will expire on {{$subscriptionPlan->trial_ends_on}}</p>
            @endif

            <p>Your next billing will be {{$subscriptionPlan->price}} USD on {{$subscriptionPlan->getNextBillingDate()}} </p>

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