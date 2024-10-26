<x-nav>
    @section('content')
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <!-- Welcome Section -->
                <h1 class="text-3xl font-bold mb-4">Welcome to Our Blog Site!</h1>
                <p class="text-gray-700 mb-4">Discover a wide range of blog posts on various topics. Stay updated with the latest articles and insights from our community.</p>

                <!-- Blog posts container (dynamically loaded content) -->
                <div id="blog-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Blog Posts will be loaded here via AJAX -->
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-6">
                    <button id="load-more" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Load More
                    </button>
                </div>
            </div>
        </div>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- AJAX and Lazy Loading Scripts -->
        <script>
            let page = 1;

            // Function to load blog posts via AJAX
            function loadBlogPosts() {
                $.ajax({
                    url: '{{ route("ajaxLoadBlogs") }}',
                    method: 'GET',
                    data: { page: page },
                    success: function (response) {
                        if (response.html) {
                            $('#blog-container').append(response.html);
                            page++; // Increment page for next request
                        } else {
                            $('#load-more').hide(); // Hide the load more button if no more posts
                        }
                    }
                });
            }

            // Lazy loading images as they come into view
            function lazyLoadImages() {
                const lazyImages = document.querySelectorAll('img.lazy');
                lazyImages.forEach(img => {
                    if (img.getBoundingClientRect().top < window.innerHeight && img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                    }
                });
            }

            // Initial load on page load
            $(document).ready(function () {
                loadBlogPosts();

                // Load more posts on button click
                $('#load-more').on('click', function () {
                    loadBlogPosts();
                });

                // Lazy load images on scroll
                $(window).on('scroll', function () {
                    lazyLoadImages();
                });
            });
        </script>
    </body>
    @endsection
</x-nav>
