    {!! Form::label('product_name', '* Produktname')!!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}

    {!! Form::label('description', 'Beschreibung')!!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

    {!! Form::label('quantity', '* Anzahl')!!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}

    {!! Form::label('image_path', 'Bilderpfad')!!}
    {!! Form::text('image_path', null, ['class' => 'form-control']) !!}

    {!! Form::label('price', '* Preis (€)')!!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}

    {!! Form::label('status', '*Status')!!}
    {!! Form::select('status', [true => 'Verfügbar', false => 'nicht Verfügbar'], null, ['class' => 'form-control', 'placeholder' => 'Status']) !!}


    {!! Form::label('category_id', '* Kategorie')!!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Kategorie']) !!}

    {!! Form::label('manufacturers_id', 'Hersteller')!!}
    {!! Form::text('manufacturers_id', null, ['class' => 'form-control']) !!}

    <br/>
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-large btn-primary btn-block']) !!}
{!! Form::close() !!}
