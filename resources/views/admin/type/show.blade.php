@extends('admin.layouts')

@section('title', 'Type')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Show Producer</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('type.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name: </strong>
                {{$type->name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image: </strong>
                <img src="data:image;base64,{{$type->image}}" width="60px" height="60px">
            </div>
        </div>
    </div>
</div>
@endsection
