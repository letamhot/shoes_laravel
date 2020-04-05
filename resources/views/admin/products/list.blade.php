@extends('admin.layouts')

@section('title', 'Products')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">
        <a href="{{ route('product.create') }}" class="btn btn-primary">Create new product</a>
        <a href="{{ route('product.trash') }}" class="btn btn-danger" style="float:right">Garbage can</a>
    </p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of products</h6>
        </div>

        <div class="col-sm-12">@include('partials.message')</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                    style="font-size: 14.5px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width='10%'>Name</th>
                            <th width='6%'>Category</th>
                            <th width='6%'>Object</th>
                            <th width='6%'>Description</th>
                            <th>Cost</th>
                            <th>Sale</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Highlight</th>
                            <th>New</th>
                            <th>Total rating</th>
                            <th>User created</th>
                            <th>User updated</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th width='10%'>Name</th>
                            <th width='6%'>Category</th>
                            <th width='6%'>Object</th>
                            <th width='6%'>Description</th>
                            <th>Cost</th>
                            <th>Sale</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Highlight</th>
                            <th>New</th>
                            <th>Total rating</th>
                            <th>User created</th>
                            <th>User updated</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($products as $key => $product)

                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->categories->name }}</td>
                            <td>{{ $product->objects->name }}</td>
                            {{-- <td><a href="{{ route('product.show', $product->id) }}">Details</a></td> --}}
                            <td><button data-url="{{ route('product.show',$product->id) }}" ​ type="button"
                                    data-target="#show" data-toggle="modal"
                                    class="btn btn-info btn-show btn-sm">Detail</button></td>
                            <td>{{ $product->unit_price }}</td>
                            <td>{{ $product->promotion_price }}</td>
                            <td>{{ $product->amount }}</td>
                            <td><img src="img/products/{{ $product->image1 }}" alt="" srcset="" width="75px">
                            </td>
                            @if($product->highlight == 1)
                            <td><a href="{{ route('product.highlights', $product->id) }}" class="ajax_link">Yes</a></td>
                            @else
                            <td><a href="{{ route('product.highlights', $product->id) }}" class="ajax_link">No</a>
                            </td>
                            @endif
                            @if($product->new == 1)
                            <td><a href="{{ route('product.new', $product->id) }}">Yes</a></td>
                            @else
                            <td><a href="{{ route('product.new', $product->id) }}">No</a></td>
                            @endif

                            <td><a href="{{ route('reivew.show', $product->id) }}">{{ count($product->reviews) }}</a>
                            </td>

                            <td><b style="color:orange">{{ $product->user_created }}</b> <br> {{ $product->created_at }}
                            </td>

                            <td><b style="color:purple">{{ $product->user_updated }}</b> <br> {{ $product->updated_at }}
                            </td>
                            <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit" title="Edit"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Do you want delete product {{$product->name}} ?')"
                                        class="btn btn-danger btn-sm"><i class="fa fa-backspace"></i></button>
                                </form>
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
    $(document).ready(function () {
        $('.btn-show').click(function(){
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    // console.log(response)
                    $('h4#name').html(response.data.name)
                    $('h1#descriptor').html(response.data.description)
                    $('span#last_updated').html("Last updated: " + response.data.updated_at.substring(0,19))
                    $('span#user_created').html("User created: " + response.data.user_created)
                    $('span#user_updated').html("User updated: " + response.data.user_updated)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
    });
</script>
@endpush