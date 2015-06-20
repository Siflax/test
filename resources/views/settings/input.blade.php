@extends('app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default" style = "height:600px">
                    <div class="panel-heading">Rules</div>

                    <div class="panel-body">
                        <div class="well">
                            Lorem ipsum dolor sit amet, natum inermis pericula sed ei, cu malis legere phaedrum nec. Qui ex decore honestatis, ex magna utinam regione qui. Adhuc eleifend appellantur id mel. No mundi ceteros his, nostrum philosophia qui in. Sententiae consequuntur quo eu, nam veri erant nominavi at, eam solum voluptua contentiones id. Nec et ancillae hendrerit, usu commodo iuvaret adolescens ut, paulo fabulas per ex.
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="@if($section==='global') active @endif tab"><a href="{{route('showInventoryRules', ['section' => 'global'])}}"><h4>Global</h4></a></li>
                            <li class="@if($section==='products') active @endif tab"><a href="{{route('showInventoryRules', ['section' => 'products'])}}"><h4>Products</h4></a></li>
                            <li class="@if($section==='variants') active @endif tab"><a  href="{{route('showInventoryRules', ['section' => 'variants'])}}"><h4>Variants</h4></a></li>
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





