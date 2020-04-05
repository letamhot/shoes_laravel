@extends('admin.layouts')

@section('title', 'Product')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h2>Show Product</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name: </strong>
            {{$product->name}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type:</strong>
            {{$product->type->name}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Producer: </strong>
            {{$product->producer->name}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Amount: </strong>
            {{$product->amount}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image: </strong>
            <img src="data:image;base64, {{$product->image}}" width="60px" height="60px">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Price_input: </strong>
            {{$product->price_input}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description: </strong>
            {!! $product->description !!}
        </div>
    </div>
</div>

@endsection
