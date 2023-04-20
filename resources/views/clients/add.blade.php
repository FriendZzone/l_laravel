@extends('layouts.client')
@section('content')
    <h1>Add product</h1>
    <form action="{{ route('category.add') }}" method="POST" id="product-form">
        @error('msg')
            {{ $message }}
        @enderror
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mb-3">
            <label for="">Product Name</label>
            <input type="text" class="form-control" name="product-name" placeholder="Product Name..."
                value="{{ old('product-name') }}">
            @error('product-name')
                <li class="alert alert-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Price</label>
            <input type="text" class="form-control" name="product-price" placeholder="Product price..."
                value="{{ old('product-price') }}">

            @error('product-price')
                <li class="alert alert-danger">{{ $message }}</li>
            @enderror
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">ADD</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#product-form').on('submit', function(e) {
                e.preventDefault();
                const productName = $('input[name="product-name"]').val();
                const productPrice = $('input[name="product-price"]').val();
                const _token = $('input[name="_token"]').val();
                let actionURL = $(this).attr('action')
                console.log(actionURL);
                $.ajax({
                    url: actionURL,
                    type: 'POST',
                    data: {
                        'product-name': productName,
                        'product-price': productPrice,
                        _token

                    },
                    dataType: 'text',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });
        })
    </script>
@endsection
