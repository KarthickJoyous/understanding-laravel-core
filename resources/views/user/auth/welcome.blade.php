@extends('base')

@section('content')
<h3>Welcome, {{auth('web')->user()->name}}</h3>
<h2>Email : {{auth('web')->user()->email}}</h2>
<button class="btn btn-danger" onclick='document.getElementById("Logout").submit()'>Logout</button>
<form method="POST" id="Logout" action="{{route('logout')}}">
    @csrf
</form>
@endsection