@extends('settings.index')

@section('settingContent')
	@include('errors.list')
	<div class="panel panel-default panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Lieferadresse ändern</h3>
		</div>
		<div class="panel-body">
			{!! Form::model($address, ['url' => 'addresses/'.$address->id, 'method' => 'PUT']) !!}
				@include('settings/addresses/_form', ['submitButtonText' => 'Ändern'])
		</div>
	</div>
@stop