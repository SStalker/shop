@extends('app')

@section('content')
	@include('errors.list')
	{!! Form::model($permission, array('method' => 'PATCH', 'route' => array('permissions.update', $permission->id))) !!}
	@include('backend/permission/_form', ['submitButtonText' => 'Update'])	
@stop