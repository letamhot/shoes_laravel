@extends('shoes.partials.layout')

@section('title', 'Login')

@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
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
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form class="user" action="{{url('/add')}}" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    value="{{old('name')}}">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{old('email')}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control" placeholder="Password">

                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="repeatPassword" class="form-control"
                                    id="exampleRepeatPassword" placeholder="Repeat Password">
                            </div>
                        </div>
                        <div class="login-box-body">

                            <!-- for validation errors -->
                            @if(count($errors) > 0)
                            <div id="error" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                @foreach($errors->all() as $error)
                                <div class="msg">{{$error}}</div>
                                @endforeach
                            </div>
                            @endif



                            @if(Session::get('error_msg'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                {{Session::get('error_msg')}}
                            </div>
                            @elseif(Session::get('success_msg'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success !</h4>
                                {{Session::get('success_msg')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button name="Submit" type="submit"
                                        class="btn btn-primary btn-user btn-block">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->
@endsection
