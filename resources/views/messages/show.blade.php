@extends('layouts.app')

@section('content')

<div class="container" id="showmsg">
	<div class="row">
	<!-- debut -->
	@foreach ($messages as $message)
		<div class="col-md-8 col-md-offset-2">
			<div class="box-msg">
				<h3>{{$message->userfrom}}</h3>
				<div class="content-msg">
					<p>{{$message->message}}</p>
				</div>
			</div>
		</div>
		@endforeach
		<!-- fin -->
	</div>
		<div class="col-md-8 col-md-offset-2">
			<label>Votre message</label>
			<input id="message" type="text" name="msg" class="form-control">
			<button id="send" type="submit" class="btn btn-custom btn-right">Envoyez</button>
		</div>
</div>
@endsection