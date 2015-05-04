@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Frequency</div>

                    <div class="panel-body">


                        {!! Form::open(array('route' => 'saveFrequency')) !!}

                        {!! Form::label('frequency', 'Daily') !!}
                        {!! Form::radio('frequency', 'Daily', $settings->frequencyIsDaily()) !!}

                        {!! Form::label('frequency', 'Weekly') !!}
                        {!! Form::radio('frequency', 'Weekly', $settings->frequencyIsWeekly()) !!}

                        {!! Form::submit('Save') !!}

                        {!! Form::close() !!}

                    </div>
                </div>
<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Webhooks</div>

                    <div class="panel-body">

                        {!! Form::open(array('route' => 'addWebhook')) !!}

                        {!! Form::label('url', 'Add Webhook') !!}
                        {!! Form::text('url') !!}
                        {!! Form::submit('Add') !!}

                        {!! Form::close() !!}

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Webhooks</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                                @if(isset($webhooks))
                                    @foreach($webhooks as $webhook)

                                        {!! Form::open(array('route' => ['deleteWebhook', $webhook->id], 'method' => 'Delete')) !!}
                                        <tr>
                                            <td>{{$webhook->url}}</td>
                                            <td class="text-right">{!! Form::submit('Remove') !!}</td>
                                        </tr>
                                        {!! Form::close() !!}

                                    @endforeach

                                @endif

                            <tbody>
                        </table>

                    </div>
                </div>
</div>
<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Emails</div>

                    <div class="panel-body">

                        {!! Form::open(array('url' => '/notifications/email')) !!}

                        {!! Form::label('emailAddress', 'Add Email') !!}
                        {!! Form::text('emailAddress') !!}
                        {!! Form::submit('Add') !!}

                        {!! Form::close() !!}

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Emails</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($emails))
                                @foreach($emails as $email)

                                    {!! Form::open(array('route' => ['deleteEmail', $email->id], 'method' => 'Delete')) !!}
                                    <tr>
                                        <td>{{$email->address}}</td>
                                        <td class="text-right">{!! Form::submit('Remove') !!}</td>
                                    </tr>
                                    {!! Form::close() !!}

                                @endforeach
                            @endif


                            <tbody>
                        </table>

                    </div>
                </div>
    </div>
            </div>

        </div>
    </div>

@endsection










