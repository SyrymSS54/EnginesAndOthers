<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <title>Search</title>
        @viteReactRefresh
    </head>
    <body>
        <x-customer.header/>
        <div class="search">
            <label>Name:</label>
            <ul class="product-list">
                @foreach ($name as $product)
                    <li class="product-item">
                        <div class="product-container">
                            <img style="max-width:259px;max-height:140px" src="/images/{{$product['description']['preview']}}">
                            <p>{{$product['name']}}</p>
                            <a href="{{ "/product?id=".$product['_id'] }}"><button>Посмотреть</button></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <label>Text:</label>
            <ul class="product-list">
            @foreach ($text as $product)
                    <li class="product-item">
                        <div class="product-container">
                        <img style="max-width:259px;max-height:140px" src="/images/{{$product['description']['preview']}}">
                            <p>{{$product['name']}}</p>
                            <a href="{{ "/product?id=".$product['_id'] }}"><button>Посмотреть</button></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <label>Tags:</label>
            <ul class="product-list">
            @foreach ($tags as $product)
                    <li class="product-item">
                        <div class="product-container">
                        <img style="max-width:259px;max-height:140px" src="/images/{{$product['description']['preview']}}">
                            <p>{{$product['name']}}</p>
                            <a href="{{ "/product?id=".$product['_id'] }}"><button>Посмотреть</button></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <label>Seller:</label>
            <ul class="product-list">
            @foreach ($seller as $product)
                    <li class="product-item">
                        <div class="product-container">
                            
                            <img style="max-width:259px;max-height:140px" src="/images/{{$product['description']['preview']}}">
                            <p>{{$product['name']}}</p>
                            <a href="{{ "/product?id=".$product['_id'] }}"><button>Посмотреть</button></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </body>
</html>
