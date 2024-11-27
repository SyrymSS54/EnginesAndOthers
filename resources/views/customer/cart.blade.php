<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <title>Корзина</title>
    </head>
    <body>
        @foreach ($results as $result)
            <div class="cart-container">
                <p><label>Продавец:</label>{{ $result['seller']['name']}}</p>
                @foreach ($result[''] as )
                
                @endforeach
            </div>
        @endforeach
    </body>
</html>