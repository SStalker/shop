
    {!! Form::label('name', '* Name der Kategorie')!!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
	</br>
    {!! Form::label('parent_id', '* Kategorie (wird dieser untergeordnet)')!!}
    {!! Form::select('parent_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Kategorie']) !!}
	</br>
	{!! Form::label('type', '* Typ')!!}
	<div class="form-group">
		<label class="radio-inline"><input type="radio" name ="type" value="root">Wurzel</label>
		<label class="radio-inline"><input type="radio" name ="type" value="child">Kind</label>
		<label class="radio-inline"><input type="radio" name ="type" value="sibling">Geschwister</label> 
	</div>
	</br>
    {!! Form::label('status', '*Status')!!}
    {!! Form::select('status', [true => 'Verfügbar', false => 'nicht Verfügbar'], null, ['class' => 'form-control', 'placeholder' => 'Status']) !!}
    <br/>
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-large btn-primary btn-block']) !!}
{!! Form::close() !!}
