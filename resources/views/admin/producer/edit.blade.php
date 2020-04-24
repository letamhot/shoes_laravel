@extends('admin.layouts')

@section('title', 'Producer')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Sửa tài khoản</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('producer.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <br>
    <form action="{{route('producer.update',$producer->id)}}" method="post" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('name')?' has-error':''}}">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $producer->name }}" class="form-control"
                        placeholder="name">
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('address')?' has-error':''}}">
                    <strong>Address:</strong>
                    <input type="text" name="address" value="{{ $producer->address }}" class="form-control"
                        placeholder="address">
                    <span class="text-danger">{{$errors->first('address')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('phone')?' has-error':''}}">
                    <strong>Phone:</strong>
                    <input type="text" name="phone" value="{{ $producer->phone }}" class="form-control"
                        placeholder="phone">
                    <span class="text-danger">{{$errors->first('phone')}}</span>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('tax_code')?' has-error':''}}">
                    <strong>Tax_code:</strong>
                    <input type="text" name="tax_code" value="{{ $producer->tax_code }}" class="form-control"
                        placeholder="tax_code">
                    <span class="text-danger">{{$errors->first('tax_code')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('image')?' has-error':''}}">
                    <strong>Image:</strong>
                    <input type="file" class="form-control" name="image" id="image">
                    <img id="image_post" src="data:image;base64,{{ $producer->image }} " width="60px" height="60px">
                    <span class="text-danger">{{$errors->first('image')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('img-js')

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#image_post').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function() {
        readURL(this);
    });
</script>
@endpush
