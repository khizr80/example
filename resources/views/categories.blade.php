<x-base>
    @section('content')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            @if (session('role') == "admin")
                <a href="{{ route('addCategory') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add
                    Category</a>
            @endif

            <div class="overflow-x-auto">
                <table id="categories-table" class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Id</th>
                            <th class="px-4 py-2 border">Title</th>
                            <th class="px-4 py-2 border">Slugs</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                // Initialize DataTable
                $('#categories-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url("/categories")}}',
                columns: [
                        { data: 'id', name: 'id' },
                        { data: 'title', name: 'title' },
                        { data: 'slugs', name: 'slugs' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });

                // Handle delete action
                $(document).on('click', '.delete-category', function() {
                    var id = $(this).data('id');
                        $.ajax({
                            url: '/categories/' + id, 
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                $('#categories-table').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                alert('An error occurred while deleting the category');
                            }
                        });
                });
            });
        </script>
    </body>
    @endsection
</x-base>
