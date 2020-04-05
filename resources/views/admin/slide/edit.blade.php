@extends('admin.layouts')

@section('title', 'Slide')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h2>Update Slide</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('slide.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<br>
<form action="{{route('slide.update',$slide->id)}}" method="post" role="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('image')?' has-error':''}}">
                <strong>Image:</strong>
                <input type="file" class="form-control" name="image" id="image">
                <img src="data:image;base64,{{ $slide->image }} " width="60px" height="60px">
                <span class="text-danger">{{$errors->first('image')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endsection
