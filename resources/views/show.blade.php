<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show blade</title>
</head>
<body>
    <p>ID : {{ $student->id }}</p>
    <p>Nama : {{ $student->name }} </p>
    <p>Score : {{ $student->score }} </p>
    <br>
    <p>Activities :</p>
    @foreach ($student->activities as $activity)
        <p>{{ $activity->name }}</p>
    @endforeach
</body>
</html>