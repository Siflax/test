

<div class="col-md-6">

    variant rules here

</div>
<div class="col-md-6">
    <h4>Add product rule</h4>
    {!! Form::open(array('route' => 'searchInventoryRules')) !!}

    <div class="form-group {{ $errors->has('productTitle') ? 'has-error' : '' }}">
        {!! Form::label('productTitle', 'Search by product title') !!}
        {!! Form::text('productTitle', null, ['class' => 'form-control'])!!}

        {!! $errors->first('productTitle', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('search', ['class'=> 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('partials.matches')

</div>





