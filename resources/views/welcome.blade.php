@extends('layouts.app')

@section('content')
<div class="upload">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Limit file size : 2MB</p>
                <form action="{{ url('/files') }}" method="POST" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="fallback">
                        <input name="files[]" type="file" multiple/>
                    </div>
                </form>
          </div>
      </div>
  </div>
</div>
@endsection
