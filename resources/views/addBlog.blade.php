<x-base>
    @section('content')
    @include('partials.navAdmin');

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">Add Blog</h1>
            <form action="{{ route('addBlogButton') }}" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
                @csrf 
                
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title:</label>
                    <input type="text" id="title" name="title" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <!-- Slugs -->
                <div class="mb-4">
                    <label for="slugs" class="block text-gray-700">Slugs:</label>
                    <input type="text" id="slugs" name="slugs" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                
                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-gray-700">Content:</label>
                    <textarea id="content" name="content" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                </div>
                
                <!-- Image -->
                <div class="mb-4">
                    <label for="file" class="block text-gray-700">Image:</label>
                    <input type="file" id="file" name="image" accept="image/*" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <input type="hidden" name="UserId" value="{{session('id')}}"  required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                
                <!-- Subcategory -->
                <div class="mb-4">
                    <label for="subcategory" class="block text-gray-700">Subcategory:</label>
                    <select name="SubCategoryId" id="subcategory" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="">Select Subcategory</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" name="add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Blog</button>
                </div>
            </form>
        </div>
    </body>
    @endsection
</x-base>
