@extends('layouts.app')

@section('content')
<div class="container">
	
	<fieldset>

		<!-- Form Name -->
		<legend>Editer le fichier</legend>

		<!-- Textarea -->
		<input type="button" class="btn btn-custom type" data-style="italic" value="italic">
		<input type="button" class="btn btn-custom type" data-style="bold"  value="Gras">
		<input type="button" class="btn btn-custom type" data-style="underline" value="Souligner">
		<input type="button" class="btn btn-custom" id="link" value="Lien">
		<input type="button" class="btn btn-custom" id="image" value="Image">
		<input type="button" class="btn btn-custom" id="title" value="Titre">
		<input type="button" class="btn btn-custom" id="order" value="Liste Ordonnée">
		<input type="button" class="btn btn-custom" id="unorder" value="Liste Non - Ordonnée">
		<input type="color" name="color" id="color">
		{{ Form::open(['url' => 'files/' . $file->id, 'method' => 'patch']) }}
		<br>
		<div class="form-group">
			<div class="row">
				<label class="col-md-12 control-label">Editer le fichier</label>
				<div class="col-md-12">
					<textarea name="textarea" class="hidden"></textarea>
					<div class="form-control" id="textarea" contenteditable="true" style="height: 300px;">
						{!! $content !!}
						<!-- findiv -->
					</div>
				</div>
			</div>
		</div>

		<!-- Button (Double) -->
		<div class="form-group">
			<div class="row">
				<label class="col-md-4 control-label" for="button1idDDSA"></label>
				<div class="col-md-12">
					{{ Form::submit('Sauvegarder', array('class' => 'btn btn-primary', 'id' => 'button1idDDSA')) }}
					<button name="button2id" class="btn btn-danger">CANCEL</button>

				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</fieldset>
	<button name="button2id" class="btn btn-info" onclick="window.location.href='/files/download/{{$file->id}}/html'">Exporter en HTML</button>
	<button name="button2id" class="btn btn-info" onclick="window.location.href='/files/download/{{$file->id}}/pdf'">Exporter en PDF</button>
</div>
@endsection
