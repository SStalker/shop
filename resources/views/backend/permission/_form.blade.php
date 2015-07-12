		{!! Form::label('name', 'Name:')!!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		
		{!! Form::label('display_name', 'Anzeigename')!!}
		{!! Form::text('display_name', null, ['class' => 'form-control']) !!}
		
		{!! Form::label('description', 'Beschreibung')!!}
		{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
		<br/>
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-large btn-primary btn-block']) !!}
	{!! Form::close() !!}