@extends('layouts.simple')

@section('content')
	@include('errors.list')
	{!! Form::open(['method' => 'POST', 'route' => 'roles.store']) !!}
		@include('backend/role/_form', ['submitButtonText' => 'Hinzufügen'])	
@stop