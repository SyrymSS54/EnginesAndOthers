<!-- <!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <title>{{ $name }}</title>
    </head>
    <body>
        <form method="post" action="{{route('customer.auth.post.signin')}}">
        @csrf
            <p><label>Email:<input required name="email" type="email"></label></p>
            <p><label>Password:<input required name="password" type="password"></label></p>
            <hr>
            <p><input type="submit" value="{{ $name }}"></p>
        </form>
    </body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }}</title>
    @Vite(['resources/css/customer/auth.signin.css'])
</head>
<body>
    <div class="auth-container">
        <form class="auth-form" method="POST" action="{{ route('customer.auth.post.signin') }}">
            @csrf
            <h2>Вход</h2>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Войти</button>
            <p>Нет аккаунта? <a href="{{ route('customer.auth.get.signup') }}">Зарегистрируйтесь</a></p>
        </form>
    </div>
</body>
</html>