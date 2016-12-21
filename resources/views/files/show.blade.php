@extends('layouts.app')

@section('content')
@foreach ($files as $file)
<div class="container">
	<div class="col-md-12">
		<div class="row">
			<?php 
			$id = Session::get('id');
			$path = public_path() . "/upload/$id/";

			if($file->type == "image/jpeg" || $file->type == "image/png"){ ?>
			<img src="/upload/{{ $file->user_id }}/{{ $file->filename }}" alt="img" class="img-responsive">
			<?php } if($file->type == "audio/mp3"){ ?>
			<audio controls>
				<source src="horse.ogg" type="audio/ogg">
					<source src="/upload/{{ $file->user_id }}/{{ $file->filename }}" type="audio/mp3">
						Your browser does not support the audio element.
					</audio>
					<?php } if($file->type == "video/mp4"){ ?>
					<video controls src="/upload/{{ $file->user_id }}/{{ $file->filename }}"></video>
					<?php } ?>
					<form action="/share" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $file->id }}">
						<label>Partager par mail :</label>
						<input type="text" name="share" placeholder="Email de la personne avec qui vous souhaitez partager se fichier !" class="form-control">
						<button type="submit" class="btn btn-custom btn-right">Partager</button>
					</form>
				</div>
			</div>
		<a href="/upload/{{ $file->user_id }}/{{ $file->filename }}" download>Télécharger</a>
		</div>
		@endforeach
		@endsection
