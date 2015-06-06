{!! Form::open(array('route' => 'saveGlobalLimit')) !!}

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">

                {!! Form::label('globalLimit', 'Inventory Limit',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                    {!! Form::text('globalLimit', isset($setting->globalLimit) ? $setting->globalLimit : null, ['style' => 'width:40px', 'class' => 'form-control'] ) !!}
                    {!! Form::hidden('id', isset($setting->id) ? $setting->id : null) !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('track', 'Track',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                    {!! Form::checkbox('isTrackedGlobally', true, isset($setting->isTrackedGlobally) ? $setting->isTrackedGlobally : true,  ['class' => 'form-control'] ) !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::submit('save', ['class'=> 'btn btn-primary']) !!}
            </div>
        </div>
    </div>

{!! Form::close() !!}