<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="css/app.css">
        {{--<script src="css/bootstrap.js"></script>--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
       <div id="app">
           <app></app>
       </div>
    </body>
    <script src="js/main.js"></script>
</html>
