{!! Form::open(array('route' => 'variants.store')) !!}

<tr>
    <td>{{$variant->title}}</td>
    <td>
        {!! Form::text('inventory_limit', $variant->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
        {!! Form::hidden('id', $variant->id) !!}
        {!! Form::hidden('product_id', $variant->product_id) !!}
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