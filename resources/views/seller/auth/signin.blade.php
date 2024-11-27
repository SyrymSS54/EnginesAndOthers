<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <title>{{ $name }}</title>
        @Vite(['resources/css/seller/auth.css'])
    </head>
    <body>
        <form method="post" action="{{ route('seller.auth.post.signin') }}" class="container">
            <h2>Вход в кабинет продавца</h2>
            @csrf
            <label>Email:</label>
            <input required name="email" type="email">
            <label>Password:</label>
            <input required name="password" type="password">
            <input type="submit" value="{{ $name }}">
        </form>
    </body>
</html>