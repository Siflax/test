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
                            <li class="active tab"><a data-remote target="#rules" href="{{route('global.index')}}"><h4>Global</h4></a></li>
                            <li class="tab"><a data-remote target="#rules" href="{{route('products.index')}}"><h4>Products</h4></a></li>
                            <li class="tab"><a data-remote target="#rules" href="{{route('variants.index')}}"><h4>Variants</h4></a></li>
                        </ul>


                        <div id = 'loading-image'></div>

                        <div id="rules">

                            @include('rules.global.index')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>







@endsection





