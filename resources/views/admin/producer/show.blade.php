@extends('admin.layouts')

@section('title', 'Producer')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Show Producer</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('producer.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name: </strong>
                {{$producer->name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type:</strong>
                {{$producer->type}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Producer: </strong>
                {{$producer->producer}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Amount: </strong>
                {{$producer->amount}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image: </strong>
                <img src="data:image;base64,{{$producer->image}}" width="60px" height="60px">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price_input: </strong>
                {{$producer->price_input}}
            </div>
        </div>
    </div>
</div>
@endsection
