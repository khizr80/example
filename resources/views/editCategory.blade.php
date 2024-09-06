<x-base>
    @section('content')
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">Edit Category</h1>
            
            <form action="{{ route('updateCategory', $category->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $category->title) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <div class="mb-4">
                    <label for="slugs" class="block text-gray-700">Slugs:</label>
                    <input type="text" id="slugs" name="slugs" value="{{ old('slugs', $category->slugs) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Category</button>
                </div>
            </form>

        </div>
    </body>
    @endsection
</x-base>
