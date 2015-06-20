

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
            {!! Form::open(array('route' => 'saveProductRule')) !!}

            <tr>
                <td>{{$variant->title}}</td>
                <td>
                    {!! Form::text('individualLimit', $variant->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                    {!! Form::hidden('variantId', $variant->id) !!}
                </td>
                <td>
                    {!! Form::checkbox('track', True, $variant->track, ['class' => 'form-control']) !!}
                </td>
                <td>
                    {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}

                    {!! link_to_route('deleteProductRule', 'X', $variant->id ,['class' => 'btn btn-danger']) !!}
                </td>
            </tr>

            {!! Form::close() !!}
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





