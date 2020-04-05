@extends('admin.layouts')

@section('title', 'Role')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 ">List Type</h1>
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-right">
            <a href="{{route('role.create')}}" class="btn btn-success float-right">Create New type</a>
            <a href="{{url('dashboard')}}" class="btn btn-primary ">Back</a>

        </div>
        <br />
    </div>
    <!-- DataTales Example -->
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
                            <th>Description</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($role as $value)

                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{ $value->description }}</td>
                            <td>
                                <a href="{{ route('type.show', $value->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('type.edit', $value->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('type.destroy', $value->id) }}" method="POST">
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
