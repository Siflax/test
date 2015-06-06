

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

                variant rules here

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






