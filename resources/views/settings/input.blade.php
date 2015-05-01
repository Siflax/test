@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        {!! Form::open(array('url' => 'settings/inventory')) !!}

                        {!! Form::label('globalLimit', 'Inventory Limit') !!}
                        {!! Form::text('globalLimit', $setting->globalLimit) !!}
                        {!! Form::hidden('id', $setting->id) !!}
                        {!! Form::submit('save') !!}

                        {!! Form::close() !!}

                        <hr/>

                        {!! Form::open(array('url' => 'settings/inventory/search')) !!}

                        {!! Form::label('productTitle', 'Search by product title') !!}
                        {!! Form::text('productTitle') !!}
                        {!! Form::submit('save') !!}

                        {!! Form::close() !!}

                        @if (isset($matches))
                            @foreach($matches as $product)
                                @include('partials.product')
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                @if (isset($products))

                    @foreach($products as $product)

                        @include('partials.product')
                    @endforeach
                @endif
            </div>

        </div>
    </div>







@endsection





