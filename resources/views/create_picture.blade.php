<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create picture</title>
</head>
<body>
    <form action="{{ route('picture.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <br>
        <input type="file" name="file">
        <br>
        <button type="submit">Submit</button>
        <p>check</p>
    </form>
</body>
</html>