@extends('shoes.partials.layout')

@section('title', 'Login')

@section('content')
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
                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-warning"><i
                            class="far fa-google"></i>Google</a>
                        </div>
                    </form>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-dark" class="small" href="password/reset/">Forgot
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
