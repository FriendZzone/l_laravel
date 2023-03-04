@extends('layouts.client')
@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection
@section('content')
    <h1>Trang chu</h1>
    @php
        echo now();
    @endphp
    {{-- @datetime() --}}
    <x-package-alert type="danger"></x-package-alert>
    {{-- <x-package-button /> --}}
@endsection
