@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Global Rules</div>

                    <div class="panel-body">
                        <div class="well">
                            Lorem ipsum dolor sit amet, natum inermis pericula sed ei, cu malis legere phaedrum nec. Qui ex decore honestatis, ex magna utinam regione qui. Adhuc eleifend appellantur id mel. No mundi ceteros his, nostrum philosophia qui in. Sententiae consequuntur quo eu, nam veri erant nominavi at, eam solum voluptua contentiones id. Nec et ancillae hendrerit, usu commodo iuvaret adolescens ut, paulo fabulas per ex.
                        </div>
                        {!! Form::open(array('route' => 'saveGlobalLimit')) !!}
                            <div class="form-group">
                                {!! Form::label('globalLimit', 'Inventory Limit') !!}
                                {!! Form::text('globalLimit', $setting->globalLimit, ['style' => 'width:40px', 'class' => 'form-control'] ) !!}
                                {!! Form::hidden('id', $setting->id) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Product Rules</div>

                    <div class="panel-body">
                        <div class="well">
                            Lorem ipsum dolor sit amet, natum inermis pericula sed ei, cu malis legere phaedrum nec. Qui ex decore honestatis, ex magna utinam regione qui. Adhuc eleifend appellantur id mel. No mundi ceteros his, nostrum philosophia qui in. Sententiae consequuntur quo eu, nam veri erant nominavi at, eam solum voluptua contentiones id. Nec et ancillae hendrerit, usu commodo iuvaret adolescens ut, paulo fabulas per ex.
                        </div>
                        <div class="col-md-6">
                            <h4>Product Rules</h4>
                            @if (isset($products))
                                @foreach($products as $product)
                                    @include('partials.product')
                                @endforeach
                            @endif
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





