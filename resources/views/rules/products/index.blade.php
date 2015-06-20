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

    @if (isset($products))


            <tbody>

                @foreach($products as $product)
                    {!! Form::open(array('route' => 'saveProductRule')) !!}

                    <tr>
                        <td>{{$product->title}}</td>
                        <td>
                            {!! Form::text('individualLimit', $product->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                            {!! Form::hidden('productId', $product->id) !!}
                        </td>
                        <td>
                            {!! Form::checkbox('track', True, $product->track, ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}
                            {!! link_to_route('deleteProductRule', 'X', $product->id ,['class' => 'btn btn-danger']) !!}
                        </td>
                    </tr>

                    {!! Form::close() !!}
                @endforeach

            </tbody>



        <?php echo $products->render(); ?>

    @endif

    </table>





</div>
<div class="col-md-6">
    <h4>Add product rule</h4>
    {!! Form::open(['data-remote', 'target' => '#searchResults','route' => 'products.search']) !!}

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

        @include('partials.matches')

    </div>
</div>









