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
        <tbody>
            <tr>
                <td class="userid"></td>
                <td class="username"></td>
                <td class="email"></td>
                <td class="role"></td>
            </tr>
        </tbody>
    </table>

@endsection