
    {!! Form::label('name', '* Name der Kategorie')!!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    {!! Form::label('parent_id', '* Kategorie')!!}
    {!! Form::select('parent_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Kategorie']) !!}

    {!! Form::label('status', '*Status')!!}
    {!! Form::select('status', [true => 'Verfügbar', false => 'nicht Verfügbar'], null, ['class' => 'form-control', 'placeholder' => 'Status']) !!}
    <br/>
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-large btn-primary btn-block']) !!}
{!! Form::close() !!}
