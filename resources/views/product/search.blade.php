<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <title>Search</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @viteReactRefresh
        @Vite(['resources/css/product/search.css','resources/js/product/search.jsx'])
    </head>
    <body>
        <x-customer.header/>
        <div class="search" id="app">
            
        </div>
    </body>
</html>
