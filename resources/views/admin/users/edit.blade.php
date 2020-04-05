@extends('admin.layouts')

@section('title', 'Users')

@section('content')
@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif

<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h2>Update Product</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('users.list')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<br>
<form action="{{route('users.update',$users->id)}}" method="post" role="form" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="form-group">

        <label>Name</label>

        <input type="text" class="form-control" name="name" value="{{ $users->name }}" required>

    </div>

    <div class="form-group">

        <label>Email</label>

        <input type="email" class="form-control" name="email" value="{{ $users->email }}" required>

    </div>

    <div class="form-group">

        <label>Password</label>

        <input type="text" class="form-control" name="phone" value="{{ $users->password }}" required>

    </div>

    <button type="submit" class="btn btn-primary">Update</button>

    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle</button>

</form>

</div>

</div>

</div>

@endsection