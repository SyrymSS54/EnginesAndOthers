<!-- <!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <title>{{ $name }}</title>
    </head>
    <body>
        <form method="post" action="{{route('customer.auth.post.signup')}}">
        @csrf
            <p><label>Имя:<input required name="first_name" type="text"></label></p>
            <p><label>Фамилия:<input required name="last_name" type="text"></label></p>
            <p><label>Телефон:<input required name="tel" type="tel"></label></p>
            <p><label>День рождения:<input required name="birth" type="date"></label></p>
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
        <form class="auth-form" method="POST" action="{{ route('customer.auth.post.signup') }}">
            @csrf
            <h2>Регистрация</h2>

            <label for="first_name">Имя</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Фамилия</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="tel" required placeholder="+7 (XXX) XXX-XXXX">

            <label for="birthdate">День рождения</label>
            <input type="date" id="birthdate" name="birth" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Зарегистрироваться</button>
            <p>Уже есть аккаунт? <a href="{{ route('customer.auth.get.signup') }}">Войти</a></p>
        </form>
    </div>
</body>
</html>