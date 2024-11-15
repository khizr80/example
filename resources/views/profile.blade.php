<x-base>
    
    @section('content')
    
    @include('partials.navAdmin');
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">Change Profile</h1>

            <!-- Form for updating profile -->
            <form action="{{ route('updateUser') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf

                <!-- Username display -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Username</label>
                    <p class="text-gray-900" >{{ session('username') }}</p>
                </div>
                
                <!-- Name input field -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" name="name" value="{{ session('user_name') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                
                <!-- New password input field -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">New Password</label>
                    <input type="password" name="new" placeholder="New password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div class="mb-4">
                    @if (session('role') == "admin")
                    <label class="block text-gray-700 font-bold mb-2">Role</label>
                    <input type="text" placeholder="role" required name="role" value="{{ session('role') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    @else
                    <input type="hidden" name="role" value="{{ session('role') }}">
                    @endif
                </div>
                
                <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Change Profile
            </button>
            <input type="hidden" name="username" value="{{ session('username') }}"><input/>
        </form>
        </div>
    </body>
    @endsection

</x-base>