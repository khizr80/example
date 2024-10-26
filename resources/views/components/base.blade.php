<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="flex items-center justify-start">
          <div class="flex-shrink-0">
          </div>
          <div class="ml-6">
            <div class="flex space-x-4">
            <x-navlink href="{{route('categories')}}">Categories</x-navlink>
              <x-navlink href="{{route('subcategories')}}">Subcategories</x-navlink>
              <x-navlink href="{{route('blogss')}}">Blog</x-navlink>
              <x-navlink href="{{route('users')}}">Users</x-navlink>
              <x-navlink href="{{route('profile')}}">Profile</x-navlink>
            </div>
          </div>
        </div>

        <!-- Logout button aligned to the right -->
        <div class="ml-auto flex items-center">
          <x-navlink href="{{ route('logoutController') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
            {{ session('user_name') }} Logout
          </x-navlink>
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
