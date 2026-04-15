<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <h1>Administradores</h1>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
        </tr>

        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
            </tr>
        @endforeach
    </table>

    @endsection
</body>
</html>