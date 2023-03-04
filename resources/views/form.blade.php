<form action="/admin/welcome" method="POST">
    <input type="text">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <button type="submit">submit</button>
</form>