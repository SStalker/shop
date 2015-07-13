@extends('app')

@section('content')
	<h1>Permissions</h1>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Anzeigename</th>
			<th>Beschreibung</th>
			<th>Erstellt am</th>
			<th>Aktionen</th>
		</thead>
		@foreach($permissions as $permission)
			<tr>
				<td>{!! $permission->id !!}</td>
				<td>{!! $permission->name !!}</td>
				<td>{!! $permission->display_name !!}</td>
				<td>{!! $permission->description !!}</td>
				<td>{!! $permission->created_at !!}</td>
				<td>
					<div class="btn-group">
					{!! HTML::link('/permissions/'.$permission->id.'/edit', 'Bearbeiten', array('class'=>'btn btn-default')) !!}
					{!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id]]) !!}
					    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
					</div>
				</td>
			</tr>
		@endforeach
	</table>
	{!! HTML::link('/permissions/create', 'Neu', array('class'=>'btn btn-primary')) !!}
@stop