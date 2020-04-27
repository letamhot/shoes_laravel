@extends('admin.layouts')

@section('title', 'Producer')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 ">List Producer</h1>
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-right">
            <a href="{{route('producer.create')}}" class="btn btn-success">Create New Producer</a>
            {{-- <a href="{{url('dashboard')}}" class="btn btn-primary ">Back</a> --}}
            <a href="{{ route('producer.trash') }}" class="btn btn-danger" style="float:right">Garbage can</a>


        </div>
        <br />
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Type </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable5" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Tax_code</th>
                            <th>Image</th>
                            <th colspan="3 ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producer as $key => $value)

                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->address}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->tax_code}}</td>
                            <td><img src="data:image;base64, {{ $value->image }}" width="60px" height="60px"></td>
                            <td><a href="{{ route('producer.show', $value->id) }}" class="btn btn-primary" type="submit"
                                    style="color:lightblue"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                            </td>
                            <td><a href="{{ route('producer.edit', $value->id) }}" class="btn btn-warning" type="submit"
                                onclick="return confirm('Are you sure to update?')" style="color:yellow"><i class="fa fa-edit" title="Edit"></i></a></td>
                            <td>
                                <form action="{{ route('producer.destroy', $value->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure to delete?')"><i
                                            class="fa fa-backspace"></i></button>
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
