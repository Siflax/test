{!! Form::open(array('route' => 'saveProductRule')) !!}

<div class="panel panel-default">

    <div class="panel-body">

        <table class="table">

            <tbody>

            <tr >

                <td>
                    {{$variant->title}}
                </td>

                <td>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                {!! Form::label('individualLimit','limit',['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::text('individualLimit', $variant->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                                    {!! Form::hidden('variantId', $variant->id) !!}
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
                                    {!! Form::checkbox('track', True, $variant->track, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-right">
                    {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}

                    {!! link_to_route('deleteProductRule', 'X', $variant->id ,['class' => 'btn btn-danger']) !!}

                </td>
                <td>

                </td>


            </tr>
            </tbody>
        </table>

        {!! Form::close() !!}

    </div>

</div>