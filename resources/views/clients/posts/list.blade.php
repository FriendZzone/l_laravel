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
    </div>
    <form action="{{ route('post.deleteAny') }}" method="post">
        <button type="submit" class="btn btn-danger">Delete</button>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th width="5%">#</th>
                    <th>Titlte</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if ($allPost->count() > 0)
                    @foreach ($allPost as $post)
                        <tr>
                            <td><input type="checkbox" name="delete[]" value="{{ $post->id }}"></td>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td><a class="btn btn-danger" onclick="return confirm('This action can not be restore! Are you sure?')" href="{{ route('post.force-delete', $post->id) }}">Delete Permently</a></td>
                            @if ($post->trashed())
                                <td><button class="btn btn-danger">Deleted</button></td>
                                <td><a class="btn btn-primary" href="{{ route('post.restore', $post->id) }}">Restore</a>
                                </td>
                            @else
                                <td><button class="btn btn-success">Active</button></td>
                            @endif
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        @csrf
    </form>
@endsection
