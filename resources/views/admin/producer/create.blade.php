@extends('admin.layouts')

@section('title', 'Producer')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left ">
                <h2>Create Producer</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('producer.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <form action="{{route('producer.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('name')?' has-error':''}}">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="name">
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('address')?' has-error':''}}">
                    <strong>Address:</strong>
                    <input type="text" name="address" class="form-control" placeholder="address">
                    <span class="text-danger">{{$errors->first('address')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('phone')?' has-error':''}}">
                    <strong>phone:</strong>
                    <input type="text" name="phone" class="form-control" placeholder="phone">
                    <span class="text-danger">{{$errors->first('phone')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('tax_code')?' has-error':''}}">
                    <strong>Tax_code:</strong>
                    <input type="text" name="tax_code" class="form-control" placeholder="tax_code">
                    <span class="text-danger">{{$errors->first('tax_code')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image :</strong>
                    <input type="file" class="form-control" name="image" id="image">
                    <span class="text-danger">{{$errors->first('image')}}</span>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Add New</button>
            </div>
        </div>
    </form>
</div>
@endsection
