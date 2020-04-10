@extends('admin.layouts')

@push('select2-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Edit bills')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-3">
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('bills.index') }}"
                    style="text-decoration: none; color: purple"><i class="fa fa-chevron-left"></i> Back bills</a>
            </h1>
        </div>
        <div class="col-sm-6"></div>
        <div class="col-sm-3">
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('bills.trash') }}"
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
                        {{ $bills->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: auto">
                        <form method="post" action="{{ route('bills.update', $bills->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('partials.message')

                            <div class="form-group @error('name') has-error has-feedback @enderror">

                                <label>Customer name</label>

                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $customer->name }}" required>

                            </div>

                            <div class="form-group @error('address') has-error has-feedback @enderror">

                                <label>Address</label>

                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ $customer->address }}" required>

                            </div>


                            <div class=" form-group @error('postcode') has-error has-feedback @enderror">

                                <label>Post code</label>

                                <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                    name="postcode" value="{{ $customer->postcode }}">

                            </div>

                            <div class="form-group @error('city') has-error has-feedback @enderror">

                                <label>City</label>

                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $customer->city }}">

                            </div>

                            <div class="form-group @error('country') has-error has-feedback @enderror">

                                <label>Country</label>

                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    name="country" value="{{ $customer->country }}">

                            </div>

                            <div class="form-group @error('phone') has-error has-feedback @enderror">

                                <label>Phone</label>

                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $customer->phone }}">

                            </div>


                            <div class="form-group @error('pay_money') has-error has-feedback @enderror">

                                <label>Pay money</label>

                                <select name="pay_money" id=""
                                    class="form-control @error('pay_money') is-invalid @enderror">
                                    <option value="0" @if($bills->pay_money==0 ) {{ "selected" }} @endif>Not paid
                                    </option>
                                    <option value="1" @if($bills->pay_money==1 ) {{ "selected" }} @endif>Paid
                                    </option>
                                </select>

                            </div>

                            <div class="form-group @error('status') has-error has-feedback @enderror">

                                <label>Status</label>

                                <select name="status" id="" class="form-control @error('status') is-invalid @enderror">
                                    <option value="0" @if($bills->status==0) {{ "selected" }} @endif>Uncomplete
                                    </option>
                                    <option value="1" @if($bills->status==1) {{ "selected" }} @endif>Complete</option>
                                </select>

                            </div>

                            <div class="form-group @error('total') has-error has-feedback @enderror">

                                <label>Total payment ($)</label>

                                <input type="text" class="form-control @error('total') is-invalid @enderror"
                                    name="total" value="{{ $bills->total }}">

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
{{-- <!-- CK editor 4 installed-->
<script src="ckeditor/ckeditor.js"></script>
<script>
    // Script Ckeditor 4
    CKEDITOR.replace("description");
</script> --}}
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