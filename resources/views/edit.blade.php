<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>
<body>
    <form action="{{ route('update', $student) }}" method="post">
        <!-- karena di html 5 method nya hanya ada post dan get aja, dan yang dibutuhin yaitu patch untuk edit data
            maka pake @method('patch') -->
        @method('patch')
        @csrf
        <input type="text" name="name" value="{{ $student->name}}">
        <input type="number" name="score" value="{{ $student->score}}">
        <button type="submit">Update</button>
    </form>
</body>
</html>