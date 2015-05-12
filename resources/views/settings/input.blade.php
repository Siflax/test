@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Global Rules</div>

                    <div class="panel-body">
                        {!! Form::open(array('route' => 'saveGlobalLimit')) !!}
                            {!! Form::label('globalLimit', 'Inventory Limit') !!}
                            {!! Form::text('globalLimit', $setting->globalLimit, ['style' => 'width:40px'] ) !!}
                            {!! Form::hidden('id', $setting->id) !!}
                            {!! Form::submit('save') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Individual Inventory Rules</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            @if (isset($products))
                                @foreach($products as $product)
                                    @include('partials.product')
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4>Add product rule</h4>
                            {!! Form::open(array('route' => 'searchInventoryRules')) !!}
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
            </div>

        </div>
    </div>







@endsection





