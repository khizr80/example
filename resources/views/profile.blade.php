<x-base>
    @section('content')

    @include('partials.navAdmin');
    <body>
        <div class="container mx-auto mt-8">

            <!-- Form for updating profile -->
            <form id="updateProfileForm" class="bg-gray-800 p-6 rounded-lg shadow-md">
                @csrf

                <!-- Username display -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        {{ session('username') }}
                    </p>
                </div>

                <!-- Name input field -->
                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" name="name" id="name" value="{{ session('user_name') }}" required
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>

                <!-- New password input field -->
                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">New Password</label>
                    <input type="password" name="new" id="new_password" placeholder="New password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>

                <div class="mb-4">
                    @if (session('role') == "admin")
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Role</label>
                    <input type="text" placeholder="role" required name="role" id="role" value="{{ session('role') }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    @else
                    <input type="hidden" name="role" id="role" value="{{ session('role') }}">
                    @endif
                </div>

                <button type="button" id="submitProfile"
                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Update Profile
                </button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#submitProfile').on('click', function (e) {
                    e.preventDefault();

                    // Gather form data
                    const data = {
                        _token: "{{ csrf_token() }}",
                        username: "{{ session('username') }}",
                        name: $('#name').val(),
                        new: $('#new_password').val(),
                        role: $('#role').val(),
                    };

                    // AJAX request
                    $.ajax({
                        url: "{{ route('updateUser') }}",
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            window.location.reload();

                    showToast('Profile updated successfully!', 'success');
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </body>
    @endsection
</x-base>
