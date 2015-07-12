@extends('account.index')

@section('account.content')

    <div class="form-group">

        {!! Form::open(['route' => 'account-settings.store']) !!}

            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
            </div>

            <div class="form-group">
                {{Form::submit('save')}}
            </div>

        {!! Form::close() !!}
    </div>
@stop