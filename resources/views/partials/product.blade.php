<h2>{{$product->title}}</h2>

<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Variant</th>
        <th>Limit</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach($product->variants as $variant)


        {!! Form::open(array('url' => 'settings/inventory/limit')) !!}

        <tr>
            <td><p>{{$variant->title}}</p></td>
            <td>
                {!! Form::text('individualLimit', $variant->inventory_limit) !!}
                {!! Form::hidden('variantId', $variant->id) !!}
                {!! Form::hidden('productId', $product->id) !!}
            </td>
            <td class="text-right">{!! Form::submit('save') !!}</td>
        </tr>




        {!! Form::close() !!}
    @endforeach


    <tbody>
</table>