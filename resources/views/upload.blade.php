<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="api_key" value="1468b212-c8d6-48e2-adfe-4e4420688284">
        <input type="file" name="upload_file"><br>
        <input type="submit" value="Загрузить">
    </form>
</body>
</html>
