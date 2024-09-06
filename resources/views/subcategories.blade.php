<x-base>
    @section('content')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            @if (session('role') == "admin")
                <a href="{{ route('addSubcategory') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add
                    Subcategory</a>
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
                        @foreach ($subcategories as $subcategory)
                            <tr class="bg-gray-100 border-b">
                                <td class="border px-4 py-2">{{ $subcategory->id }}</td>
                                <td class="border px-4 py-2">{{ $subcategory->title }}</td>
                                <td class="border px-4 py-2">{{ $subcategory->slugs }}</td>
                                <td class="border px-4 py-2">{{ $subcategory->created_at->format('d/m/y g:i A') }}</td>
                                <td class="border px-4 py-2">{{ $subcategory->updated_at->format('d/m/y g:i A') }}</td>
                                <td class="border px-4 py-2">
                                    @if (session('role') == "admin")
                                        <a href="{{ route('editSubcategory', $subcategory->id) }}"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        <a href="{{route('deleteSubcategory', $subcategory)}}"
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
