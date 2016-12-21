@extends('layouts.app')

@section('content')

@foreach ($membres as $membre)

<div class="container">
   <div class="col-md-4">
       <p>{{ $membre->name }}</p>
       <a href="{{ url('/messages/' . $membre->id) }}">Envoyez un message</a>
   </div>
</div>

@endforeach

@endsection