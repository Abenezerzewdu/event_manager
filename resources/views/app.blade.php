<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/@inertiajs/vue3"></script>
    <script src="https://unpkg.com/axios@1.6.0/dist/axios.min.js"></script>
    @vite('resources/js/app.js')
   
</head>
<body class="font-sans antialiased">
    @inertia
 </body>
</html>
