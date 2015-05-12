<h3>{{$product->title}}</h3>

<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Variant</th>
        <th>Limit</th>
        <th>Track</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach($product->variants as $variant)


        {!! Form::open(array('route' => 'saveProductLimit')) !!}

        <tr>
            <td><p>{{$variant->title}}</p></td>
            <td>
                {!! Form::text('individualLimit', $variant->inventory_limit, ['style' => 'width:40px'] ) !!}
                {!! Form::hidden('variantId', $variant->id) !!}
                {!! Form::hidden('productId', $product->id) !!}
            </td>

            <td>{!! Form::checkbox('track', True, $variant->track) !!}</td>

            <td class="text-right">{!! Form::submit('save') !!}</td>
        </tr>




        {!! Form::close() !!}
    @endforeach


    <tbody>
</table>