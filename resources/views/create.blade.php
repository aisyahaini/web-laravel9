<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    <form action="{{ route('store') }}" method="post">
        <!-- setiap buat form di laravel harus ada @csrf -->
        @csrf
        <input type="text" name="name" id="" placeholder="name">
        <input type="number" name="score" id="" placeholder="score">
        <button type="submit">Add</button>
    </form>
</body>
</html>