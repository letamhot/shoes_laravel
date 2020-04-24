@extends('admin.layouts')

@push('select2-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Product')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Create Product</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('name')?' has-error':''}}">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ old('name') }}">
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('type')?' has-error':''}}">
                    <strong>Type :</strong>
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
                    <strong>Producer :</strong>
                    {{-- <textarea name="producer" id="producer" rows="10" placeholder="producer"
                    class="form-control"></textarea> --}}
                    <select class="form-control input-width" name="producer">
                        {{-- @foreach($producer as $producers)
                    <option value="{{ $producers->id }}">{{ $producers->name }}</option>
                        @endforeach --}}
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
                <div class="form-group @error('size') has-error has-feedback @enderror">

                    <label>Size products</label>

                    <select name="size[]" multiple id="size" class="form-control @error('size') is-invalid @enderror">
                        @foreach ($size as $sizes)
                        <option value="{{ $sizes->id }}">
                            {{ $sizes->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('amount')?' has-error':''}}">
                    <strong>Amount :</strong>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="form-control">
                    <span class="text-danger">{{$errors->first('amount')}}</span>
                </div>
            </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image :</strong>
                    <input type="file" class="form-control" name="image" id="image">
                    <span class="text-danger">{{$errors->first('image')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{$errors->has('price_input')?' has-error':''}}">
                    <strong>Price_input :</strong>
                    <input name="price_input" type="number" id="price_input" value="{{ old('price_input') }}"
                        placeholder="price_input" class="form-control">
                    <span class="text-danger">{{$errors->first('price_input')}}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group @error('promotion_price') has-error has-feedback @enderror">

                    <label>Promotion_price</label>

                    <input type="text" class="form-control @error('promotion_price') is-invalid @enderror"
                        name="promotion_price" @if(old('promotion_price')) value="{{ old('promotion_price') }}" @else
                        value="0" @endif placeholder="Promotion price">

                </div>
            </div>
            <div class="form-group @error('new') has-error has-feedback @enderror">

                <label>News</label>

                <select name="new" id="" class="form-control @error('new') is-invalid @enderror">
                    <option value="0" @if(old('new')==0) {{ "selected" }} @endif>No</option>
                    <option value="1" @if(old('new')==1) {{ "selected" }} @endif>Yes</option>
                </select>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group @error('description') has-error has-feedback @enderror">

                    <strong>Description</strong>

                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description" required>{!! old('description') !!}
                </textarea>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">ADD</button>
            </div>
        </div>
    </form>
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
@push('select2-js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#size').select2({
            placeholder: "Select size"
        });
    });
</script>
@endpush
