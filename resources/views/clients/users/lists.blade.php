@extends('layouts.client')
@section('header')
    <h1>User Page</h1>
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @error('msg')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <div class="d-flex justify-content-between">
        <h4>{{ $title }}</h4>
        <a href="{{ route('users.add') }}" class="btn btn-primary">Add User</a>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($usersList))
                @foreach ($usersList as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td><a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td><a onclick="return confirm('Do you really want to delete?')" href="{{ route('users.delete', ['id' => $user->id]) }}"
                                class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">No data</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
