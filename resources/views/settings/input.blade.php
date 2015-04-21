@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(array('url' => 'settings/inventory')) !!}

        {!! Form::label('globalLimit', 'Inventory Limit') !!}
        {!! Form::text('globalLimit') !!}
        {!! Form::submit('save') !!}

    {!! Form::close() !!}
@endsection
