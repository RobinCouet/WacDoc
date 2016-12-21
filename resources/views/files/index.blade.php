@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-12">
		<div class="row">
			<a href="{{ url('/files/create') }}" class="btn btn-custom">
					Crée un fichier mywac !
			</a>
			<table class="table table-striped custab">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Type</th>
						<th class="text-center">Editer</th>
						<th>View</th>
						<th>Delete</th>
					</tr>
				</thead>
				@foreach ($files as $file)
				<tr>
					<td>{{$file->filename}}</td>
					<td>{{$file->type}}</td>
					<td class="text-center">
						<a class='btn btn-custom' href="/files/{{$file->id}}/edit"><span class="glyphicon glyphicon-edit"></span> Editer</a> 
					</td>
					<td>
						<a href="/files/{{$file->id}}" class="btn btn-success">View</a>
					</td>
					<td>
						{{ Form::open(['url' => 'files/' . $file->id, 'method' => 'DELETE']) }}
						<input type="submit" class="btn btn-default" value="Supprimer">{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
