<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta content="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $seller['company_name'] }}</title>
        @viteReactRefresh 
        @Vite(['resources/css/seller/personal.css','resources/js/seller/personal.jsx'])
    </head>
    <body>
        <div class="container">
            <div class="info">
                <label>Название компании:</label>
                <p>{{ $seller['company_name'] }}</p>
                <label>Название компании:</label>
                <p>{{ $seller['company_name'] }}</p>
            </div>
            <div class="content" id="content"></div>
        </div>
        <div id="validate_alert">
            @foreach ($errors->all() as $message)
                {!! $message !!}
            @endforeach
        </div>
        <script>
            console.log(document.getElementById('validate_alert').textContent, 'I am her')
            document.getElementById('validate_alert').textContent.trim() === '' ? '': alert(document.getElementById('validate_alert').textContent)
            
        </script>
    </body>
</html>