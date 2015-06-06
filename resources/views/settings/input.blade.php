@extends('app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Rules</div>

                    <div class="panel-body">
                        <div class="well">
                            Lorem ipsum dolor sit amet, natum inermis pericula sed ei, cu malis legere phaedrum nec. Qui ex decore honestatis, ex magna utinam regione qui. Adhuc eleifend appellantur id mel. No mundi ceteros his, nostrum philosophia qui in. Sententiae consequuntur quo eu, nam veri erant nominavi at, eam solum voluptua contentiones id. Nec et ancillae hendrerit, usu commodo iuvaret adolescens ut, paulo fabulas per ex.
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="active tab"><a data-remote href="{{route('global.index')}}"><h4>Global</h4></a></li>
                            <li class="tab"><a data-remote href="{{route('products.index')}}"><h4>Products</h4></a></li>
                            <li class="tab"><a data-remote href="{{route('variants.index')}}"><h4>Variants</h4></a></li>
                        </ul>


                        <div id = 'loading-image'></div>

                        <div id="rules">

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
            </div>

        </div>
    </div>







@endsection





