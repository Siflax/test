@extends('app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default" style = "height:600px">
                    <div class="panel-heading">Rules</div>

                    <div class="panel-body">
                        <div class="well">
                            Set inventory tracking rules on a global, per product or per variant basis.</br>
                            The more specific rules will overwrite the less specific rules: global rules will be overwritten by product rules, product rules will be overwritten by variant rules</br>
                            </br>
                            <strong>Limit:</strong>  decides at what inventory level you will be notified.</br>
                            <strong>Track:</strong>  decides if you will be notified.</br>

                        </div>

                        <ul class="nav nav-tabs">
                            <li class="@if($section==='global') active @endif tab"><a href="{{route('showInventoryRules', ['section' => 'global'])}}"><h4>Global Rules</h4></a></li>
                            <li class="@if($section==='products') active @endif tab"><a href="{{route('showInventoryRules', ['section' => 'products'])}}"><h4>Product Rules</h4></a></li>
                            <li class="@if($section==='variants') active @endif tab"><a  href="{{route('showInventoryRules', ['section' => 'variants'])}}"><h4>Variant Rules</h4></a></li>
                        </ul>


                        <div id = 'loading-image'></div>

                        <div id="rules">

                           @if(isset($setting)) @include('rules.global.index')@endif
                           @if(isset($products)) @include('rules.products.index')@endif
                           @if(isset($variants)) @include('rules.variants.index')@endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>







@endsection





