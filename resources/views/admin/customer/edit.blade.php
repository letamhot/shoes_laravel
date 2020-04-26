@extends('admin.layouts')

@section('title', 'Edit customer')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-3">
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('customer.index') }}"
                    style="text-decoration: none; color: purple"><i class="fa fa-chevron-left"></i> Back customer</a>
            </h1>
        </div>
        <div class="col-sm-6"></div>
        <div class="col-sm-3">
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('customer.trash') }}"
                    style="text-decoration: none; color: purple">Garbage can <i class="fa fa-chevron-right"></i></a>
            </h1>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Update
                        {{ $customer->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: auto">
                        <form method="post" action="{{ route('customer.update', $customer->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('partials.message')

                            <div class="form-group @error('name') has-error has-feedback @enderror">

                                <label>Name</label>

                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $customer->name }}" required>

                            </div>
                            <div class="form-group{{$errors->has('gender')?' has-error':''}}">
                                <strong>Gender:</strong>
                                <select name="gender" id="" class="form-control">
                                    <option value="1">Men</option>
                                    <option value="2">Women</option>
                                </select>
                                <span class="text-danger">{{$errors->first('gender')}}</span>
                            </div>

                            <div class="form-group @error('email') has-error has-feedback @enderror">

                                <label>Email</label>

                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $customer->email }}" required>

                            </div>

                            <div class="form-group @error('address') has-error has-feedback @enderror">

                                <label>Address</label>

                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ $customer->address }}" required>

                            </div>

                            <div class="form-group @error('postcode') has-error has-feedback @enderror">

                                <label>Postcode</label>

                                <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                    name="postcode" value="{{ $customer->postcode }}" required>

                            </div>

                            <div class="form-group @error('city') has-error has-feedback @enderror">

                                <label>City</label>

                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $customer->city }}" required>

                            </div>

                            <div class="form-group @error('phone') has-error has-feedback @enderror">

                                <label>Phone</label>

                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $customer->phone }}" required>

                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                            <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@push('ckeditor-js')
<!-- CK editor 4 installed-->
<script src="ckeditor/ckeditor.js"></script>
<script>
    // Script Ckeditor 4
    CKEDITOR.replace("description");
</script>
@endpush
