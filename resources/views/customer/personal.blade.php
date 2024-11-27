<!-- <!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta content="utf-8">
        <title>{{ $customer['first_name'].' '.$customer['last_name'] }}</title>
    </head>
    <body>
        <p><label>Имя:</label>{{ $customer['first_name'] }}</p>
        <p><label>Фамилия:</label>{{ $customer['last_name'] }}</p>
        <p><label>Телефон:</label>{{ $customer['tel'] }}</p>
        <p><label>День рождения:</label>{{ $customer['birth'] }}</p>
        <p><label>Email:</label>{{ $user['email'] }}</p>
    </body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $customer['first_name'].' '.$customer['last_name'] }}</title>
    @viteReactRefresh
    @Vite(['resources/css/customer/auth.css','resources/css/customer/cart.css','resources/js/customer/personal.jsx'])
</head>
<body>
    <div class="auth-container">
        <h2>Личный кабинет</h2>
        
        <div class="profile-info">
            <p><strong>Имя:</strong> {{ $customer['first_name'] }}</p>
            <p><strong>Фамилия:</strong> {{ $customer['last_name'] }}</p>
            <p><strong>Телефон:</strong> {{ $customer['tel'] ?? 'Не указан' }}</p>
            <p><strong>День рождения:</strong> {{ $customer['birth'] ?? 'Не указан' }}</p>
            <p><strong>Email:</strong> {{ $user['email'] }}</p>
        </div>

        <div class="profile-actions">
            <a href="{{ route('customer.auth.logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Выйти
            </a>
            <form id="logout-form" action="{{ route('customer.auth.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <div class="app" id="app"></div>
</body>
</html>