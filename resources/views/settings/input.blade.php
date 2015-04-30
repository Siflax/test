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
        {!! Form::text('globalLimit', $setting->globalLimit) !!}
        {!! Form::hidden('id', $setting->id) !!}
        {!! Form::submit('save') !!}

    {!! Form::close() !!}

    {!! Form::open(array('url' => 'settings/inventory/search')) !!}

        {!! Form::label('productTitle', 'Search by product title') !!}
        {!! Form::text('productTitle') !!}
        {!! Form::submit('save') !!}

    {!! Form::close() !!}


    @if (isset($matches))
        @foreach($matches as $product)


            <h2>{{$product->title}}</h2>
            @foreach($product->variants as $variant)
                <p>{{$variant->title}}</p>

                {!! Form::open(array('url' => 'settings/inventory/limit')) !!}

                {!! Form::label('individualLimit', 'Set Limit') !!}
                {!! Form::text('individualLimit', $variant->inventory_limit) !!}
                {!! Form::hidden('variantId', $variant->id) !!}
                {!! Form::hidden('productId', $product->id) !!}
                {!! Form::submit('save') !!}

                {!! Form::close() !!}
            @endforeach
        @endforeach
    @endif


@endsection
