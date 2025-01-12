@extends('base')

@section('content')
<h3>Welcome, {{auth('admin')->user()->name}}</h3>
<h2>Email : {{auth('admin')->user()->email}}</h2>
<button class="btn btn-danger" onclick='document.getElementById("Logout").submit()'>Logout</button>
<form method="POST" id="Logout" action="{{route('admin.logout')}}">
    @csrf
</form>
@endsection