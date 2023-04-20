@extends('layouts.client')
@section('header')
    <h1>User Page</h1>
@endsection
@section('content')
    <div class="d-flex justify-content-between">
        <h4>{{ $title }}</h4>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            Something went wrong!
        </div>
    @endif

    <form action="{{ route('users.postAdd') }}" method="POST" class="d-flex flex-column">
        <input class="mt-2 form-control" type="text" name="name" placeholder="Name" value="{{ old('name') }}">
        @error('name')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        <input class="mt-2 form-control" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        <input class="mt-2 form-control" type="text" name="password" placeholder="Password"
            value="{{ old('password') }}">
        @error('password')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        <div class="mt-2">
            <label for="group-select">Group</label>
            <select id="group-select" class="form-control" name="group_id">
                <option value="0">Select Group</option>
                @if (!empty($allGroups))
                    @foreach ($allGroups as $groupItem)
                        <option value="{{ $groupItem->id }}" {{ old('group_id') == $groupItem->id ? 'selected' : false }}>
                            {{ $groupItem->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label for="group-select">Status</label>
            <select id="status-select" class="form-control" name="status">
                <option value="0" {{ old('status') == 0 ? 'selected' : false }}>Inactive</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : false }}>Active</option>
            </select>
            @error('status')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        @csrf
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mt-3">Add</button>
            <button class="btn btn-warning mt-3" type="button" onclick="window.location = '{{ route('users.index') }}'">Back</button>
        </div>
    </form>
@endsection
