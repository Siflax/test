<div class="col-md-6">

    @include('rules.products.partials.products')



</div>
<div class="col-md-6">
    <h4>Add product rule</h4>
    {!! Form::open(['route' => ['showInventoryRules'], 'method' => 'get']) !!}

    {!! Form::hidden('section', 'products') !!}

        <div class="form-group {{ $errors->has('productTitle') ? 'has-error' : '' }}">

            <div class="input-group">
                {!! Form::text('productTitle', null, ['class' => 'form-control', 'placeholder' => 'Search by product title'])!!}
                    <span class="input-group-btn">
                        {!! Form::submit('search', ['class'=> 'btn btn-primary']) !!}
                    </span>
            </div>

            {!! $errors->first('productTitle', '<span class="help-block">:message</span>') !!}
        </div>

    {!! Form::close() !!}

    <div id="searchResults">

        @include('rules.products.partials.matches')

    </div>
</div>









