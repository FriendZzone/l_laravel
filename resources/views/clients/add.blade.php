@extends('layouts.client')
@section('content')
    <h1>Add product</h1>
    <form action="" method="POST">
        <input type="text" name="username">
        @csrf
        @method('PUT')
        <button type="submit">ADD</button>
    </form>
@endsection
