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
                {!! Form::text('individualLimit', $variant->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                {!! Form::hidden('variantId', $variant->id) !!}
                {!! Form::hidden('productId', $product->id) !!}
            </td>
            <td>{!! Form::checkbox('track', True, $variant->track, ['class' => 'form-control']) !!}</td>
            <td class="text-right">{!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}</td>
        </tr>




        {!! Form::close() !!}
    @endforeach


    <tbody>
</table>

