@extends('admin.layouts')

@section('title', 'List Posts')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
<div class="container">
    <div class="col-md-12">
        <h2>List Posts</h2>
    </div>
    <a href="{{route('posts.create')}}" class="btn btn-primary">Create New Post</a>

    {{-- {{$posts->appends(request()->query())}} --}}

    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" width=20%>Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Image</th>
                        <th scope="col">User</th>
                        <th scope="col">Create at</th>
                        <th scope="col">Update at</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $key => $post)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $post->title }}</td>
                        <td><a href="{{ route('posts.show', $post->id) }}">Show Content</a></td>
                        <td><img src="data:image;base64, {{$post->image}}" width="60px" height="60px"></td>
                        <td>{{ $post->users->name }}</td>
                        <td>{{ $post->created_at->format('Y-m-d - H-i-s') }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a></td>

                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Do you want delete?')"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
