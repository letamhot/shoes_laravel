@extends('admin.layouts')

@section('title', 'Slide')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 ">List Slide</h1>
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-right">
            <a href="{{route('slide.create')}}" class="btn btn-success float-right">Create New slide</a>
            <a href="{{url('dashboard')}}" class="btn btn-primary ">Back</a>

        </div>
        <br />
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Slide </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slide as $value)

                        <tr>
                            <td><img src="data:image;base64, {{ $value->image }}" width="60px" height="60px"></td>

                            <td href="{{ route('slide.show', $value->id) }}" class="btn btn-primary">Show</td>
                            <td href="{{ route('slide.edit', $value->id) }}" class="btn btn-warning">Edit</td>
                            <td>
                                <form action="{{ route('slide.destroy', $value->id) }}" method="POST">
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
