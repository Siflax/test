{!! Form::open(array('route' => 'saveGlobalLimit')) !!}

    <div class="col-md-6">

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Limit</th>
                <th>Track</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            {!! Form::open(array('route' => 'saveGlobalLimit')) !!}

            <tr>
                <td>Global</td>
                <td>
                    {!! Form::text('globalLimit', isset($setting->globalLimit) ? $setting->globalLimit : null, ['style' => 'width:40px', 'class' => 'form-control'] ) !!}
                    {!! Form::hidden('id', isset($setting->id) ? $setting->id : null) !!}
                </td>
                <td>
                    {!! Form::checkbox('isTrackedGlobally', true, isset($setting->isTrackedGlobally) ? $setting->isTrackedGlobally : true,  ['class' => 'form-control'] ) !!}
                </td>
                <td>
                    {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
                </td>
            </tr>

            {!! Form::close() !!}

            </tbody>

        </table>

    </div>

{!! Form::close() !!}


