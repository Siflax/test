

    @foreach($product->variants as $variant)


        <tr data-toggle="collapse" data-target="#{{$product->id}}" class="accordion-toggle">
            <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
            {!! Form::open(array('route' => 'saveProductLimit')) !!}
                <td><p>{{$variant->title}}</p></td>
                <td>
                    {!! Form::text('individualLimit', $variant->inventory_limit, ['style' => 'width:50px', 'class' => 'form-control'] ) !!}
                    {!! Form::hidden('variantId', $variant->id) !!}
                    {!! Form::hidden('productId', $product->id) !!}
                </td>
                <td>{!! Form::checkbox('track', True, $variant->track, ['class' => 'form-control']) !!}</td>
                <td class="text-right">
                    {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
                    {!! link_to_route('deleteProductLimit', 'Delete', $variant->id ,['class' => 'btn btn-danger']) !!}
                </td>
            {!! Form::close() !!}
        </tr>


        <tr>
            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="{{$product->id}}">
                    <table class="table table-striped">
                        <thead>
                        <tr><td><a href="WorkloadURL">Workload link</a></td><td>Bandwidth: Dandwidth Details</td><td>OBS Endpoint: end point</td></tr>
                        <tr><th>Access Key</th><th>Secret Key</th><th>Status </th><th> Created</th><th> Expires</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                        <tr><td>access-key-1</td><td>secretKey-1</td><td>Status</td><td>some date</td><td>some date</td><td><a href="#" class="btn btn-default btn-sm">
                                    <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>



    @endforeach









