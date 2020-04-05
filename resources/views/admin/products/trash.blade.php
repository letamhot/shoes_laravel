@extends('admin.layouts')

@section('title', 'Garbage can products')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">
        <a href="{{ route('product.index') }}" class="btn btn-primary">Home page products</a>

        <a href="{{ route('product.delete-all') }}" class="btn btn-danger float-right"
            onclick="return confirm('Do you want destroy all? All data can\'t be restore!')">Delete all</a>

        <a href="{{ route('product.restore-all') }}" class="btn btn-warning float-right mr-2"
            onclick="return confirm('Do you want restore all data?')">Restore all</a>
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Garbage can</h6>
        </div>

        <div class="col-sm-12">@include('partials.message')</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                    style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width='10%'>Category</th>
                            <th width='6%'>Description</th>
                            <th>Cost</th>
                            <th>Sale</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Highlight</th>
                            <th>New</th>
                            <th>Total rating</th>
                            <th>User deleted</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Destroy</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width='10%'>Category</th>
                            <th width='6%'>Description</th>
                            <th>Cost</th>
                            <th>Sale</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Highlight</th>
                            <th>New</th>
                            <th>Total rating</th>
                            <th>User deleted</th>
                            <th>Edit</th>
                            <th>Restore</th>
                            <th>Destroy</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($products as $key => $product)

                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->categories->name }}</td>

                            {{-- <td><a href="{{ route('product.show', $product->id) }}">Detail</a></td> --}}
                            <td><button data-url="{{ route('product.show',$product->id) }}" ​ type="button"
                                    data-target="#show" data-toggle="modal"
                                    class="btn btn-info btn-show btn-sm">Detail</button></td>

                            <td>{{ $product->unit_price }}</td>
                            <td>{{ $product->promotion_price }}</td>
                            <td>{{ $product->amount }}</td>
                            <td><img src="img/products/{{ $product->image1 }}" alt="" srcset="" width="75px">
                            </td>

                            @if($product->highlight == 1)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                            @endif

                            @if($product->new == 1)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                            @endif
                            <td>{{ count($product->reviews) }}</td>
                            <td><b style="color:orange">{{ $product->user_deleted }}</b> <br> {{ $product->deleted_at }}
                            </td>
                            <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-info"><i
                                        class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>
                            </td>
                            <td><a href="{{ route('product.restore', $product->id) }}" class="btn btn-warning"
                                    onclick="return confirm('Do you want restore product {{ $product->name }}?')">
                                    <i class="far fa-window-restore" aria-hidden="true" title="Restore"></i></a>
                            </td>

                            <td>
                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Do you want destroy product {{ $product->name }}?')">
                                    <i class="fa fa-minus-circle" title="Destroy"></i>
                                </a>
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