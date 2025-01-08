@extends('base')

@section('content')
<h2>Users ({{$total_users}})</h2>
@include('db_query_builders.users.create')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Email Verified AT</th>
            <th>Total Posts</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->email_verified_at ?: "NA"}}</td>
            <td>{{$user->total_posts}}</td>
            <td>
                <a class="btn btn-sm btn-success" href="{{route('query_builders.users.show', $user->id)}}">View</a>
                <button type="button" class="btn btn-sm btn-danger" onclick='document.getElementById("deleteUser{{$user->id}}").submit()'>Delete</button>
                <form method="POST" action="{{route('query_builders.users.show', $user->id)}}" id="deleteUser{{$user->id}}">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
</table>
@endsection