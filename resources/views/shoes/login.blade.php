@extends('shoes.partials.layout')

@section('title', 'Login')

@section('content')
<style>
    .btn-block {
        display: block;
        width: 50%;
    }
    .btn-block+.btn-block {
        margin-top: 0.5rem;
    }
    input[type="submit"].btn-block,
    input[type="reset"].btn-block,
    input[type="button"].btn-block {
        width: 100%;
    }
    form.user .btn-user {
        font-size: 1rem;
        border-radius: 10rem;
        padding: 1rem 2rem;
    }
    .btn-google {
        color: #fff;
        background-color: #ea4335;
        border-color: #fff;
    }
    .btn-google:hover {
        color: #fff;
        background-color: #e12717;
        border-color: #e6e6e6;
    }
    .btn-google:focus,
    .btn-google.focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.5);
    }
    .btn-google.disabled,
    .btn-google:disabled {
        color: #fff;
        background-color: #ea4335;
        border-color: #fff;
    }
    .btn-google:not(:disabled):not(.disabled):active,
    .btn-google:not(:disabled):not(.disabled).active,
    .show>.btn-google.dropdown-toggle {
        color: #fff;
        background-color: #d62516;
        border-color: #dfdfdf;
    }
    .btn-google:not(:disabled):not(.disabled):active:focus,
    .btn-google:not(:disabled):not(.disabled).active:focus,
    .show>.btn-google.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.5);
    }
    .btn {
        display: inline-block;
        font-weight: 400;
        color: #858796;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.35rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    @media (prefers-reduced-motion: reduce) {
        .btn {
            transition: none;
        }
    }
    .btn:hover {
        color: #858796;
        text-decoration: none;
    }
</style>
<section id="form">
    <!--form-->
    <div class="container" style ="background: center;">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form" >
                    <!--login form-->
                    <h2>Login to your account</h2>
                    <form class="user" action="{{url('signin')}}" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                name="password" placeholder="Password">
                        </div>
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <div>
                        <button type="submit" class="btn btn-default">Login</button>
                        <a href="{{ url('/auth/redirect/google') }}"
                                        class="btn btn-google btn-user btn-block">
                                        <i class="fa fa-google-plus fa-fw"></i> Login with Google
                                    </a>
                        </div>
                    </form>
                    <br>
                    <div class="text-center">
                        <a  class="small" href="password/reset/">Forgot
                            Password?</a>
                    </div>
                </div>
                <!--/login form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->
@endsection
