@extends('layouts.client')
@section('sidebar')
    @parent
    <h3>Product sidebar</h3>
@endsection
@section('content')
    <h1>Product Page</h1>
@endsection
@push('scripts')
    <script>
        console.log(123)
    </script>
@endpush
@prepend('scripts')
    <script>
        console.log(124)
    </script>
@endprepend
