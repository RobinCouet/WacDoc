@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-12">
		<div class="row">
			<table class="table table-striped custab">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Type</th>
						<th class="text-center">Edit</th>
						<th>View</th>
					</tr>
				</thead>
				@if (isset($files))
				@foreach ($files as $file)
				<tr>
					<td>{{$file->filename}}</td>
					<td>{{$file->type}}</td>
					<td class="text-center">
						<a class='btn btn-custom' href="/share/{{$file->id}}/edit"><span class="glyphicon glyphicon-edit"></span> Editer</a> 
					</td>
					<td>
						<a href="/share/{{$file->id}}" class="btn btn-success">View</a>
					</td>
				</tr>
				@endforeach
				@endif
			</table>
		</div>
	</div>
</div>
@endsection
