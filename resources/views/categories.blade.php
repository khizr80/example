<x-base>
    @section('content')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            @if (session('role') == "admin")
                <a href="{{ route('addCategory') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add
                    Category</a>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Id</th>
                            <th class="px-4 py-2 border">Title</th>
                            <th class="px-4 py-2 border">Slugs</th>
                            <th class="px-4 py-2 border">CreatedAt</th>
                            <th class="px-4 py-2 border">UpdatedAt</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="bg-gray-100 border-b">
                                <td class="border px-4 py-2">{{ $category->id }}</td>
                                <td class="border px-4 py-2">{{ $category->title }}</td>
                                <td class="border px-4 py-2">{{ $category->slugs }}</td>
                                <td class="border px-4 py-2">{{ $category->created_at->format('d/m/y g:i A') }}</td>
                                <td class="border px-4 py-2">{{ $category->updated_at->format('d/m/y g:i A') }}</td>
                                <td class="border px-4 py-2">
                                    @if (session('role') == "admin")
                                        <a href="{{ route('editCategory', $category->id) }}"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        <a href="{{route('deleteCategory', $category->id)}}"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    @endsection
</x-base>