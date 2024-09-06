<x-base>
    @section('content')
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">Edit Blog</h1>
            <form action="{{ route('updateBlog', $blog->id) }}" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
                @csrf 

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <!-- Slugs -->
                <div class="mb-4">
                    <label for="slugs" class="block text-gray-700">Slugs:</label>
                    <input type="text" id="slugs" name="slugs" value="{{ old('slugs', $blog->slugs) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-gray-700">Content:</label>
                    <textarea id="content" name="content" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('content', $blog->content) }}</textarea>
                </div>
                
                <!-- Image -->
                <div class="mb-4">
                    <label for="file" class="block text-gray-700">Image:</label>
                    <input type="file" id="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <!-- Display existing image if available -->
                    @if ($blog->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-24 h-24 object-cover">
                        </div>
                    @endif
                </div>
                
                <!-- Subcategory -->
                <div class="mb-4">
                    <label for="subcategory" class="block text-gray-700">Subcategory:</label>
                    <select name="SubCategoryId" id="subcategory" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="">Select Subcategory</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ $blog->SubCategoryId == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" name="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Blog</button>
                </div>
            </form>
        </div>
    </body>
    @endsection
</x-base>
