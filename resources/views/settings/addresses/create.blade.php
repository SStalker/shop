@extends('settings.index')

@section('settingContent')
	@include('errors.list')
	<div class="panel panel-default panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Neue Lieferadresse</h3>
		</div>
		<div class="panel-body">
			{!! Form::open(['route' => 'addresses.store', 'method' => 'POST']) !!}
				@include('settings/addresses/_form', ['submitButtonText' => 'Erstellen'])
		</div>
	</div>
@stop