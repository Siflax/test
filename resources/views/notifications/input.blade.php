@extends('layouts.panel', ['panelHeading' => 'Notifications'])

@section('panel.content')



    <div class="col-md-12">
        <div class="well">
            Set the frequency of notifications and the emails addresses the notifications will be sent to
        </div>
    </div>

    <div class="col-md-6">

        {!! Form::open(array('route' => 'saveFrequency')) !!}

        <div class="form-group">
            <div class="input-group">
                {!! Form::label('frequency', 'Daily (at 10 AM UTC)') !!}
                {!! Form::radio('frequency', 'Daily', $settings->frequencyIsDaily(), ['class' => 'form-control']) !!}
            </div>
            <div class="input-group">
                {!! Form::label('frequency', 'Weekly (Mondays at 10 AM UTC)') !!}
                {!! Form::radio('frequency', 'Weekly', $settings->frequencyIsWeekly(), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class'=> 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>

    <div class="col-md-6">


        <div class="form-group">

            {!! Form::open(array('url' => '/notifications/email')) !!}

            <div class="input-group">

                {!! Form::text('emailAddress', null, ['class' => 'form-control', 'placeholder' => 'Add Email Address']) !!}

            <span class="input-group-btn">
                {!! Form::submit('Add', ['class'=> 'btn btn-primary']) !!}
            </span>
            </div>
            {!! Form::close() !!}
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Emails</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @if(isset($emails))
                @foreach($emails as $email)

                    {!! Form::open(array('route' => ['deleteEmail', $email->id], 'method' => 'Delete')) !!}
                    <tr>
                        <td>{{$email->address}}</td>
                        <td class="text-right">{!! Form::submit('Remove', ['class'=> 'btn btn-danger']) !!}</td>
                    </tr>
                    {!! Form::close() !!}

                @endforeach

                <?php echo $emails->render(); ?>
            @endif


            <tbody>
        </table>

    </div>


@endsection










