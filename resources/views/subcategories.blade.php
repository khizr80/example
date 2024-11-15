<x-base>
    @section('content')
    @include('partials.navAdmin')
    @include('addSubcategory')
    @include('editSubcategory')
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            @if (session('role') == "admin")
                <button
                   class="toggle-modal bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add
                    Subcategory</button>
            @endif
            <div class="overflow-x-auto">
                <table id="subcategories-table" class="min-w-full bg-white shadow-md rounded-lg">
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

        <!-- Include jQuery and DataTables scripts -->
        <script>
            $(document).ready(function () {
                // Initialize DataTables
                $('#subcategories-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url("/subcategories")}}', // Route for fetching subcategory data
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'slugs', name: 'slugs'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: false, 
                            searchable: false
                        },
                    ]
                });

                // Handle delete action
                $(document).on('click', '.delete-subcategory', function() {
                    var id = $(this).data('id');  // Get the ID of the subcategory
                        $.ajax({
                            url: '/subcategories/' + id,  // URL for the delete route
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                $('#subcategories-table').DataTable().ajax.reload(); // Reload the DataTable
                                showToast('SubCategory deleted successfully!', 'success');
                           
                            },
                        });
                });
            });
        </script>

    </body>
    @endsection
</x-base>
