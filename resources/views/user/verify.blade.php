<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <h2>Welcome to our website, {{ $user->name }}</h2>
    <p>
        Click here <a href="{{ url('signup/verify/'.$user->verifyuser->token) }}">verify your email</a>.
    </p>
</body>
</html>