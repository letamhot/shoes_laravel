@extends('admin.layouts')

@section('title', 'Change password')

@section('content')
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ route('details.profile') }}"><i class="fa fa-home"></i> Profile</a>
                    {{-- <span>Change password</span> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Change password</h2>
                    <form action="{{ route('details.store') }}" method="POST">
                        @csrf
                        @include('partials.message')

                        <div class="group-input has-error has-feedback">
                            <label for="password">Current Password</label>

                            <input id="password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" autocomplete="current-password">

                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="group-input has-error has-feedback">
                            <label for="password">New Password</label>

                            <input id="new_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror" name="new_password"
                                autocomplete="current-password">

                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="group-input has-error has-feedback">
                            <label for="password">Confirm Password</label>

                            <input id="new_confirm_password" type="password"
                                class="form-control @error('new_confirm_password') is-invalid @enderror"
                                name="new_confirm_password" autocomplete="current-password">

                            @error('new_confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-facebook">Change password</button>
                        <a type="submit" style="float:right" href="{{ route('details.profile') }}"
                            class="btn btn-danger">Cancle</a>

                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

@endsection
