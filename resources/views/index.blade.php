<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
    <meta charset="UTF-8">
    <title>tomotter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css" rel="stylesheet">
</head>
 
<body>
    <div id="app">
    <v-app>
      <my-app></my-app>
    </v-app>
    </div>
    
</body>
 
</html>