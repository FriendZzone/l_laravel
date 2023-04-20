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
    <form action="" method="GET">
        <div class="row">
            <div class="col col-md-3">
                <select name="status" id="" class="form-control">
                    <option value="0">All Status</option>
                    <option value="active" {{ request()->status === 'active' ? 'selected' : false }}>Active</option>
                    <option value="inactive" {{ request()->status === 'inactive' ? 'selected' : false }}>Inactive
                    </option>
                </select>
            </div>
            <div class="col col-md-3">
                <select name="group_id" id="" class="form-control">
                    <option value="0" {{ request()->group_id === '0' ? 'selected' : false }}>All Group</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups() as $item)
                            <option value="{{ $item->id }}"
                                {{ request()->group_id === $item->id ? 'selected' : false }}>{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="search.."
                    value="{{ request()->keyword }}">
            </div>
            <div class="col col-md-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th><a href="?sort-by=name&sort-type={{ $sortType == 'asc' ? 'desc' : 'asc' }}">Name</a></th>
                <th><a href="?sort-by=email&sort-type={{ $sortType == 'asc' ? 'desc' : 'asc' }}">Email</a></th>
                <th>Group</th>
                <th><a href="?sort-by=status&sort-type={{ $sortType == 'asc' ? 'desc' : 'asc' }}">Status</a></th>
                <th><a href="?sort-by=created_at&sort-type={{ $sortType == 'asc' ? 'desc' : 'asc' }}">Created at</a></th>
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
                        <td>{{ $user->group_name }}</td>
                        <td><button
                                class="btn btn-{{ $user->status == 0 ? 'danger' : 'success' }}">{{ $user->status == 0 ? 'Inactive' : 'Active' }}</button>
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td><a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td><a onclick="return confirm('Do you really want to delete?')"
                                href="{{ route('users.delete', ['id' => $user->id]) }}"
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
    {{ $usersList->links() }}
@endsection
