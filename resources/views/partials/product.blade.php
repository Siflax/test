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

</tr>


<tr>
    <td colspan="12" class="hiddenRow">

        <div class="accordian-body collapse" id="{{$product->id}}">

            <table class="table table-striped">


                <tbody>

                    @foreach($product->variants as $variant)

                        <tr >

                            <td></td>

                            <td><p>{{$variant->title}}</p></td>
                            <td>
                                <input type="text" name="individualLimit[{{$variant->id}}]" value="{{$variant->inventory_limit}}" style = "width:50px;" class = 'form-control' >
                            </td>
                            <td>
                                <input type="checkbox" name="trackVariant[{{$variant->id}}]" value="{{$variant->track}}" style = "width:50px;" class = 'form-control' @if ($variant->track == true) checked = "checked" @else ' ' @endif >
                            </td>
                            <td class="text-right">

                            </td>

                        </tr>

                    @endforeach

                </tbody>
            </table>
          </div>
    </td>
</tr>


{!! Form::close() !!}
