@extends('app')

@section('content')
	@include('errors.list')
	{!! Form::open(['method' => 'POST', 'route' => 'permissions.store']) !!}
		@include('backend/permission/_form', ['submitButtonText' => 'Hinzufügen'])	
@stop