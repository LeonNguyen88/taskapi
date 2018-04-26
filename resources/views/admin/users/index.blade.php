@extends('layouts.admin')

@section('js')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
@section('content')
    <h1 class="page-header">Admin List</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody class="userlist">

        </tbody>
    </table>
    <h1 class="username"></h1>
@endsection