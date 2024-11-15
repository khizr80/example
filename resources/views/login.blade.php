<x-base>
    @section('content')

    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Login Form</h2>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label class="block text-gray-700 font-medium">Email Address</label>
                    <input type="email" name="username" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your email">
                </div>

                <div class="space-y-1">
                    <label class="block text-gray-700 font-medium">Password</label>
                    <input type="password" name="password" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your password">
                </div>

                <div class="mt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Login
                    </button>
                </div>

                <div class="text-center mt-4 text-gray-600">
                    Not a member? <a href="{{ url('/signup') }}" class="text-indigo-600 hover:underline">Signup now</a>
                </div>
            </form>

        </div>
    </div>

    @endsection
</x-base>
