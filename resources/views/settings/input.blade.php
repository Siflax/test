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


                                <h2>{{$product->title}}</h2>

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Variant</th>
                                        <th>Limit</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($product->variants as $variant)


                                        {!! Form::open(array('url' => 'settings/inventory/limit')) !!}

                                        <tr>
                                            <td><p>{{$variant->title}}</p></td>
                                            <td>
                                                {!! Form::text('individualLimit', $variant->inventory_limit) !!}
                                                {!! Form::hidden('variantId', $variant->id) !!}
                                                {!! Form::hidden('productId', $product->id) !!}
                                            </td>
                                            <td class="text-right">{!! Form::submit('save') !!}</td>
                                        </tr>




                                        {!! Form::close() !!}
                                    @endforeach


                                    <tbody>
                                </table>






                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>







@endsection





