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
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('bills.details', $bills->id_bill) }}"
                    style="text-decoration: none; color: purple"><i class="fa fa-chevron-left"></i> Back bills
                    detail</a>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Update bills detail
                        {{ $bills->id }} of bills
                        {{ $bills->id_bill }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: auto">
                        <form method="post" action="{{ route('billDetail.update', $bills->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('partials.message')

                            <div class="form-group @error('id_product') has-error has-feedback @enderror">

                                <label>Products</label>

                                <input type="text" value="{{ $product->id }} - {{ $product->name }}"
                                    class="form-control" disabled>

                            </div>

                            <div class="form-group @error('size') has-error has-feedback @enderror">

                                <label>Size</label>

                                <select name="size" id="size" class="form-control @error('size') is-invalid @enderror">
                                    @foreach ($size_product as $key => $size)

                                    <option value="{{ $size->size->id }}" @if($bills->size == $size->size->id)
                                        {{ "selected" }}
                                        @endif>{{ $size->size->name }}</option>

                                    @endforeach
                                </select>

                            </div>


                            <div class=" form-group @error('quantity') has-error has-feedback @enderror">

                                <label>Quantity</label>

                                <input type="number" min="1" max='{{ $bills->products->amount }}'
                                    class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                    value="{{ $bills->quantity }}">

                            </div>

                            <div class="form-group @error('discount') has-error has-feedback @enderror">

                                <label>Discount (%)</label>

                                <input type="numtber" @if(!empty($bills->discount))
                                value="{{ $bills->discount }}"
                                @else
                                value="0"
                                @endif
                                class="form-control"
                                class="form-control @error('discount') is-invalid @enderror" name="discount">

                            </div>

                            <div class="form-group @error('status') has-error has-feedback @enderror">

                                <label>Status</label>

                                <select name="status" id="" class="form-control @error('status') is-invalid @enderror">
                                    <option value="0" @if($bills->status == 0) {{ "selected" }} @endif>Uncomplete
                                    </option>
                                    <option value="1" @if($bills->status == 1) {{ "selected" }} @endif>Complete</option>
                                </select>

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

{{-- @push('select2-js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#size').select2({
            placeholder: "Select size"
        });
    });
</script>
@endpush --}}