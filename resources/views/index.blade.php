<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <h1>{{ __('welcome to this page!') }}</h1>

    <!-- mengecek locale bahasa -->
    <p>Locale : {{ App::getLocale() }}</p>

    <!-- tombol untuk mengubah bahasa pada web -->
    <a href="{{ route('set_locale', 'en') }}">English</a>
    <a href="{{ route('set_locale', 'id') }}">Indonesian</a>

    <br><br>

    @if(Auth::check())
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <p>{{__('Name')}} : {{ $user->name }}</p>
        <p>{{__('Email')}} : {{ $user->email }}</p>
        <p>{{__('Role')}} : {{ $user->role }}</p>
        <p>ID : {{ $id }}</p>
    @else
        <!-- yang direturn yang bagian ini -->
        <a href="{{ route('login') }}">{{__('Login')}}</a>
        <a href="{{ route('register') }}">{{__('Register')}}</a>
    @endif

    <table border="1px">
        <tr>
            <th>ID</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Score')}}</th>
            <th>{{__('Actions')}}</th>
        </tr>
        @foreach ($data as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>
                    <!-- memberikan link pada daftar nama agar bisa diklik dan untuk akses route pada blade -->
                    <!-- show sebagai nama route, $student->id sebagai parameter -->
                    <a href="{{ route('show', $student->id)}}">{{ $student->name }}</a>
                </td>
                <td>{{ $student->score }}</td>
                <td>
                    <!-- untuk edit data -->
                    <form action="{{ route('edit', $student) }}" method="get">
                        @csrf
                        <button type="submit">{{__('Edit')}}</button>
                    </form>
                    <form action=" {{ route('delete', $student) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit">{{__('Delete')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br>

    {{__('Current Page')}} : {{ $data->currentPage() }} <br> <!-- Memperlihatkan halaman yang sedang diakses -->
    {{__('Total Data')}} : {{ $data->total() }} <br> <!-- Memperlihatkan total data yang ditampilkan -->
    {{__('Data Per Page')}} : {{ $data->perPage() }} <br> <!-- Memperlihatkan data per halaman yang diakses -->

    <!-- karena di laravel ada bug, maka didalam fungsi link dikasi pagination::bootsrap-4 karena menampilkan navigation apa adanya -->
    {{ $data->links('pagination::bootstrap-4') }} 
</body>
</html>