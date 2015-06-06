{!! Form::open(array('route' => 'saveProductRule')) !!}

<div class="panel panel-default">




    <div class="panel-heading" >
        <strong style="font-size:1.4em">{{$product->title}}</strong>
        <div class="text-right" style="display:inline-block;float:right">
            {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}
            @if ($display != 'search')
                {!! link_to_route('deleteProductRule', 'X', $product->id ,['class' => 'btn btn-danger']) !!}
            @endif
        </div>

    </div>

    <div class="panel-body">




        <table class="table">

            <tbody>

            <tr >

                <td>

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

        {!! Form::close() !!}

    </div>

</div>