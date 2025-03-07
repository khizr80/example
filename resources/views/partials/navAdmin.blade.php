<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="flex items-center justify-start">
          <div class="flex-shrink-0">
          </div>
          <div class="ml-6">
            <div class="flex space-x-4">
              <a href="{{ route('categories') }}"
                class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">
                Categories
              </a>
              <a href="{{ route('subcategories') }}"
                class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">
                Subcategories
              </a>
              <a href="{{ route('blogss') }}"
                class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">
                Blog
              </a>
              <a href="{{ route('users') }}"
                class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">
                Users
              </a>
              <a href="{{ route('convertblog') }}"
                class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">
                Convert Blog
              </a>
              <a href="{{ route('profile') }}"
                class="rounded-md text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 text-sm font-medium">
                Profile
              </a>
            </div>

          </div>
        </div>

        <!-- Logout button aligned to the right -->
        <div class="ml-auto flex items-center">
          <a href="{{ route('logoutController') }}"
            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
            {{ session('user_name') }} Logout
          </a>

        </div>
      </div>
    </div>
  </nav>
