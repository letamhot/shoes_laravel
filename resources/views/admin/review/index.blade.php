@extends('admin.layouts')

@section('title', 'Review')

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Review
                @foreach($product as $products)
                {{ $products->product->name }}</h6>
            @endforeach
        </div>

        <div class="col-sm-12">@include('partials.message')</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable9" width="100%" cellspacing="0"
                    style="font-size: 14.5px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width='35%'>Comment</th>
                            <th>Rating</th>
                            <th>Products</th>
                            <th>User created</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width='35%'>Comment</th>
                            <th>Rating</th>
                            <th>Products</th>
                            <th>User created</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($reviews as $key => $review)

                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $review->name }}</td>
                            <td>{{ $review->email }}</td>
                            <td style="width: auto; word-break: break-all;">{{ $review->comment }}</td>
                            <td>{{ $review->rating }}
                                @if($review->rating > 0)
                                <span style="color: #FAC451;">
                                    <i class="fa fa-star"></i>
                                </span>
                                @else
                                {{ "No rating" }}
                                @endif
                            </td>
                            <td>{{ $review->product->name}}</td>
                            <td><b style="color:orange">{{ $review->user_created }}</b> <br>
                                {{ $review->created_at }}
                            </td>
                            <td>
                                <form action="{{ route('review.destroy', $review->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Do you want delete reviews {{$review->name}} ?')"
                                        class="btn btn-danger"><i class="fa fa-backspace"></i></button>
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
@endsection