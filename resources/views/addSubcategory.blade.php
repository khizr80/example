<x-base>
    @section('content')
    <body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Add Subcategory</h1>
        <form action="{{ route('addSubcategoryButton') }}" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf   
        <div class="mb-4">
                <label for="title" class="block text-gray-700">Title:</label>
                <input required type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="slugs" class="block text-gray-700">Slugs:</label>
                <input type="text" id="slugs" name="slugs" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700">Category:</label>
                <select required id="category" name="CategoryID" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" name="add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Subcategory</button>
            </div>
        </form>
    </div>
</body>

    @endsection
</x-base>
