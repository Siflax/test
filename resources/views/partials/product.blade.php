<tr data-toggle="collapse" data-target="#{{$product->id}}" class="accordion-toggle">
    <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
    {!! Form::open(array('route' => 'saveProductRule')) !!}
    <td><p>test</p></td>
    <td>
        {!! Form::text('individualLimit', $product->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
        {!! Form::hidden('productId', $product->id) !!}
    </td>
    <td>{!! Form::checkbox('track', True, $product->track, ['class' => 'form-control']) !!}</td>
    <td class="text-right">
        {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
        {!! link_to_route('deleteProductRule', 'Delete', $product->id ,['class' => 'btn btn-danger']) !!}
    </td>
    {!! Form::close() !!}
</tr>


<tr>
    <td colspan="12" class="hiddenRow">

        <div class="accordian-body collapse" id="{{$product->id}}">

            <table class="table table-striped">


                <tbody>

                    @foreach($product->variants as $variant)

                        <tr >

                            <td></td>
                            {!! Form::open(array('route' => 'saveVariantRule')) !!}
                            <td><p>{{$variant->title}}</p></td>
                            <td>
                                {!! Form::text('individualLimit', $variant->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                                {!! Form::hidden('variantId', $variant->id) !!}
                                {!! Form::hidden('productId', $product->id) !!}
                            </td>
                            <td>{!! Form::checkbox('track', True, $variant->track, ['class' => 'form-control']) !!}</td>
                            <td class="text-right">
                                {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
                                {!! link_to_route('deleteVariantRule', 'Delete', $variant->id ,['class' => 'btn btn-danger']) !!}
                            </td>
                            {!! Form::close() !!}

                        </tr>


                    @endforeach

                </tbody>
            </table>
          </div>
    </td>
</tr>







