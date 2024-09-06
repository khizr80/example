<x-base>
    @section('content')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
                <a href="{{ route('addBlog') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add
                    Blog</a>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Title</th>
                            <th class="px-4 py-2 border">Subcategory</th>
                            <th class="px-4 py-2 border">Category</th>
                            <th class="px-4 py-2 border">Image</th>
                            <th class="px-4 py-2 border">Created At</th>
                            <th class="px-4 py-2 border">Updated At</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr class="bg-gray-100 border-b">
                                <td class="border px-4 py-2">{{ $blog->id }}</td>
                                <td class="border px-4 py-2">{{ $blog->title }}</td>
                                <td class="border px-4 py-2">{{ $blog->subcategory->title ?? 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $blog->getCategoryTitle() }}</td>

                                <!-- <td class="border px-4 py-2">{{ $blog->subcategory->title ?? 'N/A' }}</td> -->
                                <td class="border px-4 py-2">
                                    @if ($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                            class="w-24 h-24 object-cover">
                                    @endif
                                </td>
                                <!-- <td class="border px-4 py-2">{{ $blog->image }}</td> -->
                                <td class="border px-4 py-2">{{ $blog->created_at->format('d/m/y g:i A') }}</td>
                                <td class="border px-4 py-2">{{ $blog->updated_at->format('d/m/y g:i A') }}</td>
                                <td class="border px-4 py-2">
                                    @if (session('role') == "admin"||session('id')==$blog->UserId)
                                        <a href="{{ route('editBlog', $blog) }}"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        <a href="{{ route('deleteBlog', $blog) }}"
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