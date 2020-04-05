@extends('admin.layouts')

@section('title', 'Product')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h2>Update Product</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<br>
<form action="{{route('product.update',$product->id)}}" method="post" role="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('name')?' has-error':''}}">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="name">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('type')?' has-error':''}}">
                <strong>Type:</strong>
                <select class="form-control input-width" name="type">
                    @foreach ($type as $types)
                    <option value="{{ $types->id }}" @if(old('type')==$types->id)
                        {{ "selected" }}
                        @endif
                        >{{ $types->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{$errors->first('type')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('producer')?' has-error':''}}">
                <strong>Producer:</strong>
                <select class="form-control input-width" name="producer">
                    @foreach ($producer as $producers)
                    <option value="{{ $producers->id }}" @if(old('producer')==$producers->id)
                        {{ "selected" }}
                        @endif
                        >{{ $producers->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{$errors->first('producer')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('amount')?' has-error':''}}">
                <strong>Amount:</strong>
                <textarea class="form-control" rows="10" name="amount"
                    placeholder="amount">{{ $product->amount }}</textarea>
                <span class="text-danger">{{$errors->first('amount')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('image')?' has-error':''}}">
                <strong>Image:</strong>
                <input type="file" class="form-control" name="image" id="image">
                <img src="data:image;base64,{{ $product->image }} " width="60px" height="60px">
                <span class="text-danger">{{$errors->first('image')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('price_input')?' has-error':''}}">
                <strong>Price_input:</strong>
                <textarea class="form-control" rows="10" name="price_input"
                    placeholder="price_input">{{ $product->price_input }}</textarea>
                <span class="text-danger">{{$errors->first('price_input')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('description')?' has-error':''}}">
                <strong>Description:</strong>
                <textarea class="form-control" rows="10" name="description" id="description"
                    placeholder="description">{{ $product->description }}</textarea>
                <span class="text-danger">{{$errors->first('description')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
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
