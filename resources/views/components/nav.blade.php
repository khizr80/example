<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="{{ asset('styles.css') }}"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="flex items-center justify-start">
          <div class="flex-shrink-0">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="ml-6">
            <div class="flex space-x-4">
            <x-navlink href="{{route('userSideHome')}}">Home</x-navlink>
              <!-- <x-navlink href="{{route('userSideContactUs')}}">Blog</x-navlink> -->
              <x-navlink href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&source=mailto&to=voicesen@worldbank.org">ContactUs</x-navlink>
              <x-navlink href="{{route('userSideAboutUs')}}">AboutUs</x-navlink>
            </div>
          </div>
        </div>

        </div>
      </div>
    </div>
</nav>

<main>
    @yield('content') <!-- This is where the content section from extending views will be inserted -->
</main>  
<x-message></x-message>
</body>
</html>
