<div class="panel panel-default">
    <div class="panel-heading"><strong>{{$product->title}}</strong></div>

    <div class="panel-body">


        <table class="table">

            <tbody>

                <tr >

                    <td>
                        <button data-toggle="collapse" data-target="#{{$product->id}}" class="accordion-toggle btn btn-default"><span class="glyphicon glyphicon-eye-open"> variants</span></button>
                    </td>

                    {!! Form::open(array('route' => 'saveProductRule')) !!}

                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Limit</span>
                            {!! Form::text('individualLimit', $product->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                            {!! Form::hidden('productId', $product->id) !!}
                        </div>
                    </td>
                    <td>
                        {!! Form::checkbox('track', True, $product->track, ['class' => 'form-control']) !!}
                    </td>
                    <td class="text-right">
                        {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}

                    </td>
                    <td>
                        {!! link_to_route('deleteProductRule', 'Delete', $product->id ,['class' => 'btn btn-danger']) !!}
                    </td>


                </tr>

            </tbody>
        </table>





        <div class="accordian-body collapse" id="{{$product->id}}">

            <table class="table table-striped">

                <tbody>

                    @foreach($product->variants as $variant)

                        <tr >

                            <td></td>

                            <td><p>{{$variant->title}}</p></td>
                            <td>
                                <input type="text" name="variants[{{$variant->id}}][individualLimit]" value="{{$variant->inventory_limit}}" style = "width:50px;" class = 'form-control' >
                            </td>
                            <td>
                                <input type="checkbox" name="variants[{{$variant->id}}][track]" value="{{$variant->track}}" style = "width:50px;" class = 'form-control' @if ($variant->track == true) checked = "checked" @else ' ' @endif >
                            </td>
                            <td class="text-right">

                            </td>

                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>


        {!! Form::close() !!}

    </div>

</div>