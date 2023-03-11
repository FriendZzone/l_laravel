<h1>add category {{ $id = null }}</h1>
<form action="<?php
echo route('category.handleAdd');
?>" method="POST">
    <div>
        <input type="text" name="id" placeholder="Category name">
        <?php echo csrf_field(); ?>
        {{-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> --}}
    </div>
    <button type="submit">ADD</button>
</form>
