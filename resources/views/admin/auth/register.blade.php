@extends('base')

@section('content')
<h2>Admin Register</h2>
<form method="POST" action="{{route('admin.auth.register.register')}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputName1">Name address</label>
        <input type="text" name="name" class="form-control" id="exampleInputName1" aria-describedby="NameHelp" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" value="1" name="remember" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    <a href="{{route('admin.auth.login.form')}}">Login</a>
</form>
@endsection