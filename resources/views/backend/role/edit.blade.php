@extends('layouts.simple')

@section('content')
	@include('errors.list')
	{!! Form::model($role, array('method' => 'PATCH', 'route' => array('roles.update', $role->id))) !!}
	@include('backend/role/_form', ['submitButtonText' => 'Update'])	
@stop