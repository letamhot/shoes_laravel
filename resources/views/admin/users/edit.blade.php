@extends('admin.layouts')

@push('select2-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Edit Users')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-3">
            <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('users.index') }}"
                    style="text-decoration: none; color: purple"><i class="fa fa-chevron-left"></i> Back users</a>
            </h1>
        </div>
        <div class="col-sm-6"></div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Update
                        {{ $users->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: auto">
                        <form method="post" action="{{ route('users.update', $users->id) }}"
                            enctype="multipart/form-data" id="my-form">
                            @csrf
                            @method('PUT')

                            @include('partials.message')

                            <div class="form-group @error('name') has-error has-feedback @enderror">

                                <label>Name</label>

                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $users->name }}" required>

                            </div>

                            <div class="form-group @error('phone') has-error has-feedback @enderror">

                                <label>Phone</label>

                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $users->phone }}" >

                            </div>

                            <div class="form-group @error('address') has-error has-feedback @enderror">

                                <label>Address</label>

                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ $users->address }}" >

                            </div>

                            <div class="form-group @error('role') has-error has-feedback @enderror">

                                <label>Role users</label>

                                <select name="role[]" multiple id="role"
                                    class="form-control @error('role') is-invalid @enderror">
                                    @foreach ($roles as $key => $role)
                                    @if(count($users->roles) > 0)
                                    @foreach ($users->roles as $item)
                                    <option value="{{ $role->id }}" {{ $role->id === $item->id ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                    @endforeach
                                    @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary"
                                onclick="return confirm('Are you sure update this users?')" id="btn-submit"
                                style="border: none">Update</button>

                            <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancle
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@push('select2-js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#role').select2({
            placeholder: "Select role"
        });
    });
</script>
@endpush