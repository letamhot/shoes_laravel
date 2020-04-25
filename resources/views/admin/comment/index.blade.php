@extends('admin.layouts')

@section('title', 'Comment')

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Comment
                @foreach($comment as $comments)
                {{ $comments->commentable_id }}</h6>
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
                            <th>Name User</th>
                            <th>Products</th>
                            <th width='35%'>Comment</th>
                            <th>User created</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name User</th>
                            <th>Products</th>
                            <th width='35%'>Comment</th>
                            <th>User created</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($comment as $key => $comments)

                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $comments->user->name }}</td>
                            <td>{{ $comments->product->name }}</td>
                            <td style="width: auto; word-break: break-all;">{{ $comments->comment }}</td>
                            <td><b style="color:orange">{{ $comments->created_at }}</b> <br>

                            </td>
                            <td>
                                <form action="{{ route('comment.destroy', $comments->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Do you want delete comments {{$comments->guest_name}} ?')"
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