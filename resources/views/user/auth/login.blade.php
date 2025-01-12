@extends('base')

@section('content')
<h2>Login</h2>
<form method="POST" action="{{route('login')}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" name="remember" value="1" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="{{route('auth.register.form')}}">Register</a>
</form>
@endsection