@extends('layouts.app')

@section('content')

<div class="container">
	<form action="{{ url('/files/create') }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-6 col-md-offset-3">
			<label>Nom de votre fichier :</label>
			<input type="text" name="name" class="form-control">
			<button class="btn btn-custom btn-right">Crée</button>
		</div>
	</form>
</div>
@endsection
