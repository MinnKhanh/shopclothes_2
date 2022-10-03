<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>{{ $messenger }}</h3>
    <form action="{{ route('auth.resetpassword') }}" method="GET">
        @csrf
        <input type="text" value='{{ $email }}' style="display: none;" name='email'>
        <button class="btn btn-primary mb-3">Go</button>
    </form>
</body>

</html>
