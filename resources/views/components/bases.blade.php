<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</head>
<body>

<main>
    @yield('content') <!-- This is where the content section from extending views will be inserted -->
</main>  
<x-message></x-message>
</body>
</html>