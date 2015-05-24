<tr data-toggle="collapse" data-target="#{{$product->id}}" class="accordion-toggle">
    <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
    {!! Form::open(array('route' => 'saveProductRule')) !!}
    <td><p>test</p></td>
    <td>
        {!! Form::text('individualLimit', null, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
        {!! Form::hidden('variantId', null) !!}
        {!! Form::hidden('productId', null) !!}
    </td>
    <td>{!! Form::checkbox('track', True, null, ['class' => 'form-control']) !!}</td>
    <td class="text-right">
        {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
        {!! link_to_route('deleteProductRule', 'Delete', null ,['class' => 'btn btn-danger']) !!}
    </td>
    {!! Form::close() !!}
</tr>



@foreach($product->variants as $variant)





        <tr>
            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="{{$product->id}}">
                    <table class="table table-striped">
                      

                        <tbody>
                        <tr data-toggle="collapse" data-target="#{{$product->id}}" class="accordion-toggle">
                            <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
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
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>



    @endforeach









