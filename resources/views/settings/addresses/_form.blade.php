	{!! Form::label('firstname', 'Vorname:')!!}
	{!! Form::text('firstname', old('firstname'), ['class' => 'form-control']) !!}
	
	{!! Form::label('lastname', 'Nachname:')!!}
	{!! Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}

	<div class="row">	
		<div class="col-xs-10">
			{!! Form::label('street', 'Straße:')!!}
			{!! Form::text('street', old('street'), ['class' => 'form-control']) !!}
		</div>	
		<div class="col-xs-2">
			{!! Form::label('housenumber', 'Hausnummer:')!!}
			{!! Form::text('housenumber', old('housenumber'), ['class' => 'form-control']) !!}
	  </div>
  </div>
	{!! Form::label('postcode', 'PLZ:')!!}
	{!! Form::input('number', 'postcode', old('postcode'), ['class' => 'form-control']) !!}
	
	{!! Form::label('city', 'Stadt:')!!}
	{!! Form::text('city', old('city'), ['class' => 'form-control']) !!}
	
	{!! Form::label('state', 'Bundesland:')!!}
	{!! Form::text('state', old('state'), ['class' => 'form-control']) !!}
	
	{!! Form::label('country', 'Land:')!!}
	{!! Form::text('country', old('country'), ['class' => 'form-control']) !!}
	
	<br/>
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-large btn-primary btn-block']) !!}
{!! Form::close() !!}