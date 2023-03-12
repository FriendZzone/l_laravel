@extends('layouts.client')
@section('header')
    <h1>User Page</h1>
@endsection
@section('content')
    <div class="d-flex justify-content-between">
        <h4>{{ $title }}</h4>
    </div>

    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            Something went wrong!
        </div>
    @endif

    <form action="{{ route('users.postEdit', ['id' => $id]) }}" method="POST" class="d-flex flex-column">
        <input class="mt-2 form-control" type="text" name="name" placeholder="Name"
            value="{{ old('name') ?? $userDetail->name }}">
        @error('name')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        <input class="mt-2 form-control" type="text" name="email" placeholder="Email"
            value="{{ old('email') ?? $userDetail->email }}">
        @error('email')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        <input class="mt-2 form-control" type="text" name="password" placeholder="Password"
            value="{{ old('password') ?? $userDetail->password }}">
        @error('password')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        @csrf
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <button class="btn btn-warning mt-3">Back</button>
        </div>
    </form>
@endsection
