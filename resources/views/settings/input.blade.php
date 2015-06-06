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

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">

                                    {!! Form::label('globalLimit', 'Inventory Limit',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-2">
                                        {!! Form::text('globalLimit', isset($setting->globalLimit) ? $setting->globalLimit : null, ['style' => 'width:40px', 'class' => 'form-control'] ) !!}
                                        {!! Form::hidden('id', isset($setting->id) ? $setting->id : null) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('track', 'Track',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-2">
                                        {!! Form::checkbox('isTrackedGlobally', true, isset($setting->isTrackedGlobally) ? $setting->isTrackedGlobally : true,  ['class' => 'form-control'] ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
                                </div>
                            </div>
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

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#"><h4>Products</h4></a></li>
                            <li><a href="#"><h4>Variants</h4></a></li>
                        </ul>

                        <div class="col-md-6">
                            @include('partials.products')
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
                    </div>
                </div>
            </div>

        </div>
    </div>







@endsection





