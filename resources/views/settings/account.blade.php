@extends('settings.index')

@section('settingContent')
	@include('errors.list')
	<div class="panel panel-default panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Kontodaten ändern</h3>
		</div>
		<div class="panel-body">
			{!! Form::model($user,['url' => 'settings/update-account', 'method' => 'POST']) !!}
				{!! Form::label('username', 'Name:')!!}
				{!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
				
				{!! Form::label('email', 'Email:')!!}
				{!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
				
				{!! Form::label('oldpassword', 'Altes Passwort')!!}
				{!! Form::password('oldpassword', ['class' => 'form-control']) !!}
				
				{!! Form::label('newpassword', 'Neues Passwort:')!!}
				{!! Form::password('newpassword', ['class' => 'form-control']) !!}
				
				{!! Form::label('newpassword_confirmation', 'Neues Passwort wiederholen')!!}
				{!! Form::password('newpassword_confirmation', ['class' => 'form-control']) !!}
				<br/>
				{!! Form::submit('Ändern', ['class' => 'btn btn-large btn-primary btn-block']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	<!--
	<div class="panel panel-default panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Passwort zurücksetzen</h3>
		</div>
		<div class="panel-body">
			
    			Passwort vergessen? <a href="{!! url('/password/email') !!}">Hier klicken</a>
		</div>
	</div>-->
	<br/><br/>
	<div class="panel panel-default panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Lieferadressen</h3>
		</div>
		<div class="panel-body">
			<div class="row-fluid">
				@foreach($addresses as $address)					
					<address class="col-md-6">
						<strong>{!! $user->firstname !!} {!! $user->lastname !!}</strong><br>
						{!! $address->street_address !!}<br>
						{!! $address->postcode !!} {!! $address->city !!}<br>
						{!! $address->state !!}<br>
						{!! $address->country !!}<br>
						{!! Form::open(['url' => 'addresses/'. $address->id.'/edit', 'method' => 'GET']) !!}
						<button type="submit" style="float:left; margin-right:5px;" class="btn btn-warning">
							 <span class="glyphicon glyphicon-pencil"></span>
						</button>
						{!! Form::close() !!}

						{!! Form::open(['url' => 'addresses/'. $address->id, 'method' => 'DELETE']) !!}
						<button type="submit" style="float:left;" class="btn btn-danger">
							 <span class="glyphicon glyphicon-remove"></span>
						</button>
						{!! Form::close() !!}
					</address>	
				@endforeach
			</div>
			{!! Form::open(['url' => 'addresses/create', 'method' => 'GET']) !!}
				{!! Form::submit('Neue Adresse hinzufügen', ['class' => 'btn btn-large btn-primary']) !!}
			{!! Form::close() !!}

		</div>
	</div>	


@stop