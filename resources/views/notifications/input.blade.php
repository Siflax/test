@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Frequency</div>

                    <div class="panel-body">
                        <div class="well">
                            Lorem ipsum dolor sit amet, natum inermis pericula sed ei, cu malis legere phaedrum nec. Qui ex decore honestatis, ex magna utinam regione qui. Adhuc eleifend appellantur id mel. No mundi ceteros his, nostrum philosophia qui in. Sententiae consequuntur quo eu, nam veri erant nominavi at, eam solum voluptua contentiones id. Nec et ancillae hendrerit, usu commodo iuvaret adolescens ut, paulo fabulas per ex.
                        </div>

                        {!! Form::open(array('route' => 'saveFrequency')) !!}

                        <div class="form-group">

                        {!! Form::label('frequency', 'Daily') !!}
                        {!! Form::radio('frequency', 'Daily', $settings->frequencyIsDaily(), ['class' => 'form-control']) !!}

                        {!! Form::label('frequency', 'Weekly') !!}
                        {!! Form::radio('frequency', 'Weekly', $settings->frequencyIsWeekly(), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}
                        </div>
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
                        <div class="well">
                            Lorem ipsum dolor sit amet, natum inermis pericula sed ei, cu malis legere phaedrum nec. Qui ex decore honestatis, ex magna utinam regione qui. Adhuc eleifend appellantur id mel. No mundi ceteros his, nostrum philosophia qui in. Sententiae consequuntur quo eu, nam veri erant nominavi at, eam solum voluptua contentiones id. Nec et ancillae hendrerit, usu commodo iuvaret adolescens ut, paulo fabulas per ex.
                        </div>

                        {!! Form::open(array('url' => '/notifications/email')) !!}
                            <div class="form-group">
                            {!! Form::label('emailAddress', 'Add Email') !!}
                            {!! Form::text('emailAddress', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                            {!! Form::submit('Add', ['class'=> 'btn btn-primary']) !!}
                            </div>
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










