

<div class="col-md-6">


    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Limit</th>
            <th>Track</th>
            <th></th>
        </tr>
        </thead>


        @if (isset($variants))
        <tbody>
        @foreach($productTitles as $productTitle)
            <tr>
                <td><strong>{{$productTitle}}</strong></td>
                <td>                </td>
                <td>                </td>
                <td>                </td>
            </tr>
            @foreach($variants as $variant)

                @if ($variant->product_title === $productTitle)
                    @include('rules.variants.partials.variant')
                @endif
            @endforeach
        @endforeach
        </tbody>



        <?php echo $variants->render(); ?>

    @endif

    </table>

</div>

<div class="col-md-6">
    <h4>Add Variant rule</h4>
    {!! Form::open(['route' => ['showInventoryRules'], 'method' => 'get']) !!}

        {!! Form::hidden('section', 'variants') !!}

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


    <div id="searchResults" class="scrollable">
        @include('rules/variants/partials/matches')

    </div>

</div>





