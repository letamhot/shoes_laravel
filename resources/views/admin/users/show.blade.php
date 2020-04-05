@extends('admin.layouts')

@section('title', 'Users')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h2>Show Producer</h2>
        </div>
        <div class="pull-right">
            <a href="{{route('users.list')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name: </strong>
            {{$users->name}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email: </strong>
                {{$users->email}}
            </div>
        </div>
    </div>
</div>
@endsection