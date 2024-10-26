<x-base>

@section('content')
    <div class="container mx-auto mt-8">
        @if (session('role') == "admin")
            <a href="{{ route('addUser') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add User</a>
        @endif

        <div class="overflow-x-auto">
            <table id="users-table" class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Id</th>
                        <th class="px-4 py-2 border">Username</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/users")}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'username', name: 'username' },
                    { data: 'name', name: 'name' },
                    { data: 'role', name: 'role' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
          $('body').on('click', '.delete-user', function () {
        var userId = $(this).data('id');
        
            $.ajax({
                url: '/users/' + userId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // Ensure CSRF token is sent
                },
                success: function (response) {
                    $('#users-table').DataTable().ajax.reload(); // Reload table data
                },
            });
    });
    </script>
@endsection

</x-base>
