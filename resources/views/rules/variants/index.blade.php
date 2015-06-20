

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

        @foreach($variants as $variant)
            @include('rules.variants.partials.variant')
        @endforeach

        </tbody>



        <?php echo $variants->render(); ?>

    @endif

    </table>

</div>

<div class="col-md-6">
    <h4>Add Variant rule</h4>
    {!! Form::open(array('route' => 'searchInventoryRules')) !!}

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

    @include('partials.matches')

</div>





