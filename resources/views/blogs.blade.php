<x-base>
    @section('content')
    @include('partials.navAdmin');

    <div class="container mx-auto mt-8">
        <!-- Add Blog Button -->
        <a href="{{ route('addBlog') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Add Blog
        </a>

        <!-- Blog List Table -->
        <div class="overflow-x-auto">
            <table id="blogs-table" class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Subcategory</th>
                        <th class="px-4 py-2 border">Category</th>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- DataTables and Ajax Script -->
    <script>
        $(document).ready(function () {
            var table =  $('#blogs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/blogs/data") }}', // Use your correct route URL here

                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'subcategory.title', name: 'subcategory.title', defaultContent: 'N/A' },
                    { data: 'category', name: 'category' },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, full, meta) {
                            if (data) {
                                return data;
                            } else {
                                return 'No Image';
                            }
                        }
                    }
                    ,
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
            $(document).on('click', '.delete-blog', function () {
        var blogId = $(this).data('id');

            $.ajax({
                url: '/blogs/' + blogId, // Use the appropriate URL for the delete action
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    table.ajax.reload(); // Reload DataTable after deleting
                },
            });
    });
        });
    </script>

    @endsection
</x-base>
