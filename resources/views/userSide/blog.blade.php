<x-nav>
    @section('content')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-3xl font-bold mb-4">{{ $blog->title }}</h1>

                <p class="text-gray-700 mb-4">{{ $blog->content }}</p>

                <p class="text-gray-500 mb-4">
                    <strong>Category:</strong> {{ $blog->getCategoryTitle() }} <br>
                    <strong>Subcategory:</strong> {{ $blog->subcategory->title}}
                </p>
                @if ($blog->image)
            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-auto rounded-lg mb-2 lazy" >
        @else
            <img src="{{$blog->image}}" alt="Placeholder" class="w-full h-auto rounded-lg mb-2 lazy" data-src="https://via.placeholder.com/300">
        @endif
            </div>
        </div>
    </body>

    @endsection
</x-nav>
