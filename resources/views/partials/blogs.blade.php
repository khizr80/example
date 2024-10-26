@foreach($blogs as $blog)
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2">{{ $blog->title }}</h3>
        <p class="text-gray-600 mb-2">{{ Str::limit($blog->content, 100) }}</p>

        <!-- Display Category and Subcategory -->
        <p class="text-gray-500 mb-2">
            <strong>Category:</strong> {{ $blog->getCategoryTitle() }} <br>
            <strong>Subcategory:</strong> {{ $blog->subcategory->title ?? 'N/A' }}
        </p>

        <!-- Check if the blog has an image -->
        @if ($blog->image)
            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-auto rounded-lg mb-2 lazy" >
        @else
            <img src="{{$blog->image}}" alt="Placeholder" class="w-full h-auto rounded-lg mb-2 lazy" data-src="https://via.placeholder.com/300">
        @endif
        <a href="{{ route('userSideBlog', $blog) }}" class="text-blue-500 hover:underline">Read more</a>
    </div>
@endforeach
