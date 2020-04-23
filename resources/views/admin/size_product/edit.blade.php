@extends('admin.layouts')

@section('title', 'Quantity')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-3">
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('product.index') }}"
                    style="text-decoration: none; color: purple"><i class="fa fa-chevron-left"></i> Back product</a>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Update quantity-size of
                        product "{{ $product->name }}", id: {{ $product->id }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: auto">
                        <form method="post" action="{{ route('qtyPost', $product->id) }}"
                            enctype="multipart/form-data" id="my-form">
                            @csrf
                            @include('partials.message')
                            <?php $i=0; ?>
                            @foreach ($id_product as $qty)
                            <div class="form-group @error('qty{{ $i }}') has-error has-feedback @enderror">
                                <label>{{ $qty->size->name }}</label>
                                <input type="number" min="0" max="10000"
                                    class="form-control @error('qty{{ $i }}') is-invalid @enderror"
                                    name="qty{{ $i }}" value="{{ $qty->qty }}" required>
                            </div>
                            <?php $i++; ?>
                            @endforeach
                            <button type="submit" class="btn btn-primary" id="btn-submit"
                                style="border: none">Update</button>
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