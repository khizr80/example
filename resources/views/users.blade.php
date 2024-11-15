<x-base>
    @section('content')
    @include('partials.navAdmin')
    @include('addUser')
    @include('editUser')

    @if (session('role') == "admin")
        <button id="toggle"
            class="toggle-modal block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Add User
        </button>
    @endif

    <div class="container mx-auto mt-8">

        <div class="overflow-x-auto">
            <table id="users-table" class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Id</th>
                        <th class="px-4 py-2 border">Username</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Actions</th> <!-- Action column -->
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script>
        
        $(document).ready(function () {
            var userRole = "{{ session('role') }}";  // Pass the session role to JavaScript

            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("users")}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'username', name: 'username' },
                    { data: 'name', name: 'name' },
                    { data: 'role', name: 'role' },
                    {
                        data: null, name: 'action', orderable: false, searchable: false, render: function () {
                            if (userRole === "admin") {
                                return `
                                    <button type="button" class=" edit-user bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                                    <a href="javascript:void(0)" class="delete-user bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>
                                `;
                            } else {
                                return '';
                            }
                        }
                    }
                ]
            });

            $('body').on('click', '.delete-user', function () {
                var userId = this.parentNode.parentNode.children[0].textContent;

                $.ajax({
                    url: '/users/' + userId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Ensure CSRF token is sent
                    },
                    success: function (response) {
                        $('#users-table').DataTable().ajax.reload(); // Reload table data

                    },
                    error: function (xhr) {
                        showToast(errorMessage, 'error');
                    }
                });
            });
        });

    </script>
    @endsection
</x-base>