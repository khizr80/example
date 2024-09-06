<x-base>

    @section('content')
    <div class="container mx-auto mt-8">
        @if (session('role') == "admin")
            <a href="{{route('addUser')}}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add User</a>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Id</th>
                        <th class="px-4 py-2 border">Username</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Password</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="6" class="border px-4 py-2 text-center">No users found</td>
                        </tr>
                    @else
                        @foreach ($users as $user)
                            <tr class="bg-gray-100 border-b">
                                <td class="border px-4 py-2">{{ $user->id }}</td>
                                <td class="border px-4 py-2">{{ $user->username }}</td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->password }}</td>
                                <td class="border px-4 py-2">{{ $user->role }}</td>
                                <td class="border px-4 py-2">
                                    @if (session('role') == "admin")
                                        <a href="{{ route('editUser', $user->id) }}"class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        <a href="{{ route('deleteUser', $user->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @endsection

</x-base>