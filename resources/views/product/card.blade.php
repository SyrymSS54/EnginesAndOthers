<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$name}}</title>
        @viteReactRefresh
        @Vite(['resources/js/product/card.jsx','resources/css/app.css','resources/css/product/card.css','resources/css/product/cart.css'])
    </head>
    <body>
        <x-customer.header/>
        <div id="card" class="card">
            <ul class="img-list">
                <li class="img"><img src="{{ "images/".$description['preview']}}"></li>
                @foreach ($description['photos'] as $photo)
                    <li class="img"><img src="{{ "images/".$photo}}"></li>
                @endforeach
            </ul>
            <div class="info">
                <p>{{$name}}</p>
                <P>{{$description['text']}}</P>
                <label>Тэги:</label>
                <ul class="info-list">
                    @foreach ($description['tags'] as $tag)
                        <li>{{ $tag }}</li>
                    @endforeach
                </ul>
                <label>Индекс:</label>
                <ul class="info-list">
                    <li>{{ $description['index'] }}</li>
                </ul>
                <label>Продавец:</label>
                <ul class="info-list">
                    <li>{{ $info['seller']['name']}}</li>
                </ul>
                <label>Количества:</label>
                <ul class="info-list">
                    <li>{{ $info['count']}}</li>
                </ul>
            </div>
            <div class="button-list">
                <label>Цена:</label>
                <div class="price">{{$info['price']}} <div class="item"></div></div>
                <!-- <button id="cart">Корзину</button> -->
                <div id="cart"><button>Корзину</button></div>
            </div>
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