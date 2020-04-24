@extends('admin.layouts')

@section('title', 'Product')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 ">List Product</h1>
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-right">
            <a href="{{route('product.create')}}" class="btn btn-success">Create New Product</a>
            <a href="{{ route('product.trash') }}" class="btn btn-danger" style="float:right">Garbage can</a>

        </div>
        <br />
    </div>
    <div class="col-sm-12">@include('partials.message')</div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable6" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Producer</th>
                            <th>Size/Quantity</th>
                            {{-- <th>Amount</th> --}}
                            <th>Image</th>
                            <th>Price_input</th>
                            <th>Price_sale</th>
                            <th>New</th>
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th colspan="4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $key => $value)

                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->type->name}}</td>
                            <td>{{$value->producer->name}}</td>
                            <?php $i =0?>
                            <td>
                                @foreach ($value->size_product as $size)
                                {{ $size->size->name }}:
                                <span>
                                    @if($size->qty < 1) <b style="color:#DC143C">
                                        {{ $size->qty }}</b><br>
                                        @elseif($size->qty < 11) <b style="color:orange">
                                            {{ $size->qty }}</b><br>
                                            @else
                                            <b style="color:blue">{{ $size->qty }}</b><br>
                                            @endif
                                            @endforeach
                                </span>

                                <span style="color:#DC143C">Total:
                                    <b>{{ $value->size_product->sum('qty') }}</b></span>
                            </td>
                            {{-- <td>{{ $value->size_product->sum('qty')}}</td> --}}

                            <td><img src="data:image;base64, {{$value->image}}" width="60px" height="60px"></td>
                            <td>{{number_format($value->price_input)}}</td>
                            <td>{{ number_format($value->promotion_price) }}</td>
                            @if($value->new == 1)
                            <td><a href="{{ route('product.new', $value->id) }}"
                                    style="color:#32CD32; font-weight: bold"
                                    onclick="return confirm('Do you want change news column of this product?')">Yes</a>
                            </td>

                            @else

                            <td><a href="{{ route('product.new', $value->id) }}" style="color:red; font-weight: bold"
                                    onclick="return confirm('Do you want change news column of this product?')">No</a>
                            </td>

                            @endif
                            <td><button data-url="{{ route('product.show',$value->id) }}" ​ type="button"
                                    data-target="#show" data-toggle="modal"
                                    class="btn btn-info btn-show btn-sm">Detail</button></td>

                            <td>{{$value->created_at}}</td>

                            <td>{{$value->updated_at}}</td>
                            <td>
                                {{-- <a href="{{ route('product.show', $value->id) }}" class="btn
                                btn-primary">Show</a>
                                --}}
                                <a href="{{ route('product.edit', $value->id) }}" class="btn btn-warning" type="submit"
                                    style="color:yellow"><i class="fa fa-edit" title="Edit"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('product.destroy', $value->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure to delete?')"><i class="fa fa-backspace"
                                            title="Delete"></i></button>
                                </form>
                            </td>
                            <td>
                                <a href={{route('qtyGet', $value->id)}} class="btn btn-primary" type="submit"
                                    style="color:lightblue"><i class="fa fa-window-restore" title="ADD"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@push('show-ajax')
{{-- @csrf ajax--}}
<meta name="csrf-token" content="{{ csrf_token() }}">​
<script type="text/javascript" charset="utf-8">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.btn-show').click(function() {
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    // console.log(response)
                    $('h4#name').html(response.data.title)
                    $('h1#descriptor').html(response.data.description)
                    $('span#created_at').html("Created_at: " + response.data.created_at
                        .substring(0, 19))
                    $('span#updated_at').html("Updated_at: " + response.data.updated_at
                        .substring(0, 19))
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
    });
</script>
@endpush
