@extends('app')

@section('content')
	<h1>Roles</h1>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Anzeigename</th>
			<th>Beschreibung</th>
			<th>Erstellt am</th>
			<th>Aktionen</th>
		</thead>
		@foreach($roles as $role)
			<tr>
				<td>{!! $role->id !!}</td>
				<td>{!! $role->name !!}</td>
				<td>{!! $role->display_name !!}</td>
				<td>{!! $role->description !!}</td>
				<td>{!! $role->created_at !!}</td>
				<td>
					<div class="btn-group">
					{!! HTML::link('/roles/'.$role->id.'/edit', 'Bearbeiten', array('class'=>'btn btn-default')) !!}
					{!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id]]) !!}
					    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
					</div>
				</td>
			</tr>
		@endforeach
	</table>
	{!! HTML::link('/roles/create', 'Neu', array('class'=>'btn btn-primary')) !!}
@stop