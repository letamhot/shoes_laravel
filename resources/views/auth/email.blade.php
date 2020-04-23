@extends('admin.layouts')

@section('title', 'Profile')

@section('content')

<style>
    label {
        color: rgba(85, 85, 85, .8);
    }
</style>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ route('details.profile') }}"><i class="fa fa-home"></i> Profile</a>
                    {{-- <span>Change mailbox</span> --}}
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
                <div class="register-form">
                    <h2>Change mailbox</h2>
                    <span style="text-align: center">To update the new email, please confirm by entering the current
                        password</span>
                    <hr>

                    <form action="{{ route('verifyemail') }}" method="post" class="beta-form-checkout">
                        @csrf

                        <table>
                            <tr>
                                <td><label for="">Email address: &nbsp;</label> </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                        </table><br>

                        <div class="form-input @error('email') has-error has-feedback @enderror">
                            <label for="email">New email address</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                autocomplete="email" autofocus required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div><br>

                        <div class="form-input has-error has-feedback">

                            <label for="current_password">Current Password</label>

                            <input type="password" id="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" required
                                autocomplete="current_password">

                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <br><br>

                        <button type="submit" class="site-btn register-btn">Confirm</button>
                        <a type="submit" style="float:right" href="{{ route('details.profile') }}"
                            class="btn btn-danger">Cancle</a>
                    </form>

                    {{-- <div class="switch-login">
                        <a href="{{ route('details.profile') }}" class="or-login">Cancle</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
<!-- Register Form Section End -->

@endsection
