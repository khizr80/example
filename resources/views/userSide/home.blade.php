<x-nav>
    @section('content')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <!-- Welcome Section -->
                <h1 class="text-3xl font-bold mb-4">Welcome to Our Blog Site!</h1>
                <p class="text-gray-700 mb-4">Discover a wide range of blog posts on various topics. Stay updated with the latest articles and insights from our community.</p>
                
                <!-- Sample Blog Posts -->
                <h2 class="text-2xl font-semibold mb-4">Recent Blog Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($blogs as $blog)
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 mb-2">{{ Str::limit($blog->content, 100) }}</p>
                            
                            <!-- Display Category and Subcategory -->
                            <p class="text-gray-500 mb-2">
                                <strong>Category:</strong> {{ $blog->getCategoryTitle()}} <br>
                                <strong>Subcategory:</strong> {{ $blog->subcategory->title ?? 'N/A' }}
                            </p>

                            <!-- Check if the blog has an image -->
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-auto rounded-lg mb-2">
                            @else
                                <img src="https://via.placeholder.com/300" alt="Placeholder" class="w-full h-auto rounded-lg mb-2">
                            @endif
                            <a href="{{route('userSideBlog',$blog)}}" class="text-blue-500 hover:underline">Read more</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>

    @endsection
</x-nav>
