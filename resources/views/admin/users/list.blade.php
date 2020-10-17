@extends('admin.layouts')

@section('title', 'Users')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 ">List User</h1>
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-right">
            <a href="{{url('dashboard')}}" class="btn btn-primary ">Back</a>

        </div>
        <br />
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable10" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Email verified at</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th colspan="2">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @if(count($users) == 0)

                        <td colspan="12" class="text-center font-weight-bold">No data</td>

                        @else

                        @foreach($users as $key => $user)

                        <tr>

                            <th scope="row">{{ ++$key }}</th>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>
                            <td>{{ $user->email_verified_at }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                {{$role->name}}
                                @endforeach
                            </td>
                            <td>{{ $user->created_at->format("d-m-Y H:i:s") }}</td>
                            <td>{{ $user->updated_at->format("d-m-Y H:i:s") }}</td>
                            @if(Auth::user()->email == 'letamhot@gmail.com')
                            <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a></td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Do you want delete?')"
                                        class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            @endif

                        </tr>

                        @endforeach

                        @endif

                    </tbody>

                </table>

                <div style="float:right"> {{ $users->appends(request()->query()) }} </div>

            </div>

        </div>

        {{--  </div>  --}}

        @endsection
