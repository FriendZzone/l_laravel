<h1>Upload file</h1>
<form action="{{ route('category.handleFile') }}" method="POST" enctype="multipart/form-data">
    <div>
        <input type="file" name="photo" placeholder="Category name">
        {{ csrf_field() }}
    </div>
    <button type="submit">ADD</button>
</form>
