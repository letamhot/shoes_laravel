@extends('admin.layouts')

@section('title', 'Create New Post')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <h2>Create New Post</h2>

        </div>

        @include('partials.message')

        <div class="col-md-12">

            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                @csrf

                <div class="form-group">

                    <label>Title</label>

                    <input type="text" class="form-control" name="title" required>

                </div>

                <div class="form-group @error('description') has-error has-feedback @enderror">

                    <label>Description</label>

                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description" required>{!! old('description') !!}
                </textarea>

                </div>

                <div class="form-group @error('image') has-error has-feedback @enderror">
                    <label for="image">Image Post</label>
                    <input id="imgPost" type="file" name="image"
                        class="form-control @error('image') is-invalid @enderror" onchange="readURL(event)">
                    <img id="image" width="200" height="200">
                </div>

                <button type="submit" class="btn btn-primary">Create</button>

                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

            </form>
        </div>

    </div>
</div>
@endsection
@push('ckeditor-js')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
