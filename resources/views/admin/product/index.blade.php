@extends('admin.layouts')

@section('title', 'Product')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 ">List Product</h1>
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-right">
            <a href="{{route('product.create')}}" class="btn btn-success float-right">Create New Product</a>
            <a href="{{url('dashboard')}}" class="btn btn-primary ">Back</a>

        </div>
        <br />
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Type </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Producer</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Price_input</th>
                            <th>Description</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>

                            <th colspan="3 ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $value)

                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->type->name}}</td>
                            <td>{{$value->producer->name}}</td>
                            <td>{{$value->amount}}</td>
                            <td><img src="data:image;base64, {{$value->image}}" width="60px" height="60px"></td>
                            <td>{{$value->price_input}}</td>
                            <td><button data-url="{{ route('product.show',$value->id) }}" ​ type="button"
                                    data-target="#show" data-toggle="modal"
                                    class="btn btn-info btn-show btn-sm">Detail</button></td>

                            <td>{{$value->created_at}}</td>

                            <td>{{$value->updated_at}}</td>
                            <td>
                                {{-- <a href="{{ route('product.show', $value->id) }}" class="btn btn-primary">Show</a>
                                --}}
                                <a href="{{ route('product.edit', $value->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('product.destroy', $value->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure to delete?')">Delete</button>
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
                    $('h4#name').html(response.data.title)
                    $('h1#descriptor').html(response.data.description)
                    $('span#created_at').html("Created_at: " + response.data.created_at.substring(0,19))
                    $('span#updated_at').html("Updated_at: " + response.data.updated_at.substring(0,19))
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
    });
</script>
@endpush
