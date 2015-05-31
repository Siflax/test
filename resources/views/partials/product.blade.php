{!! Form::open(array('route' => 'saveProductRule')) !!}

<div class="panel panel-default">




    <div class="panel-heading" >
        <strong>{{$product->title}}</strong>
        <div class="text-right" style="display:inline-block;float:right">
            {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}
            {!! link_to_route('deleteProductRule', 'X', $product->id ,['class' => 'btn btn-danger']) !!}
        </div>

    </div>

    <div class="panel-body">




        <table class="table">

            <tbody>

                <tr >

                    <td>
                        <div data-toggle="collapse" data-target="#{{$product->id}}" class="accordion-toggle btn btn-default">show variants</div>
                    </td>



                    <td>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('individualLimit','limit',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-2">
                                        {!! Form::text('individualLimit', $product->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                                        {!! Form::hidden('productId', $product->id) !!}
                                    </div>
                                </div>
                            </div>
                        </div>



                    </td>
                    <td>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('track','track',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-2">
                                        {!! Form::checkbox('track', True, $product->track, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="text-right">


                    </td>
                    <td>

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