{!! Form::open(array('route' => 'products.store')) !!}

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