<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>Document</title>
</head>

<body>
    <h1 class="mt-4">Document</h1>
    <div id="app">
    </div>
    <div>
        <iframe data="https://laravel.com/docs/8.x/mix#react" width="800px" height="600px"
            style="overflow:auto;border:5px ridge blue">
        </iframe>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
