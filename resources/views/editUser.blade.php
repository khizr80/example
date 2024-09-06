<x-base>
    @section('content')
    <div class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">Change Profile</h1>
            <form action="{{ route('updateUser', $user->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Username</label>
                    <p class="text-gray-900">{{ $user->username }}</p>
                    <input type="hidden" value="{{ $user->username }}" name="username">

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" value="{{ $user->name }}" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">New Password</label>
                    <input type="password" placeholder="New password" name="new" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Role</label>
                    <input type="text" placeholder="Role" required name="role" value="{{ $user->role }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Change Profile
                </button>
            </form>
        </div>
    </div>
    @endsection
</x-base>
