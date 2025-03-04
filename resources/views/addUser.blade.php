<!-- Main modal with backdrop -->
<div id="authentication-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center">
    <!-- Greyed-out background -->
    <div class="fixed inset-0 bg-gray-900 opacity-50"></div>

    <!-- Modal content -->
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add New User
                </h3>
                <button type="button"
                    class="close-modal end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="addUserForm" class="space-y-4" method="POST">
                    @csrf
                    <!-- Name Field -->
                    <div>
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="John Doe" required />
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@company.com" required />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="••••••••" required />
                    </div>

                    <!-- Role Dropdown -->
                    <div>
                        <label for="role"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select name="role" id="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="" disabled selected>Select a role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.toggle-modal').click(function () {
            $('#authentication-modal').removeClass('hidden').addClass('flex');
        });

        $('.close-modal').click(function () {
            $('#authentication-modal').addClass('hidden').removeClass('flex');
        });
        $(document).mouseup(function (e) {
            var modal = $("#authentication-modal"); // The full modal (including backdrop)
            var modalContent = modal.find('.relative.bg-white'); // Only the modal content

            if (!modalContent.is(e.target) && modalContent.has(e.target).length === 0) {
                modal.addClass('hidden').removeClass('flex');
            }
        });

        $('#addUserForm').on('submit', function (e) {
            e.preventDefault();  // Prevent the default form submission
            const formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: "{{ route('addUser') }}", // Your Laravel route for adding a user
                type: 'POST',
                data: formData,
                success: function (response) {
                    showToast('User added successfully!', 'success');
                    $('#authentication-modal').addClass('hidden').removeClass('flex');
                },
                error: function (xhr) {
                    let errorMessage = 'An error occurred!';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    $('#authentication-modal').addClass('hidden').removeClass('flex');
                    showToast(errorMessage, 'error');
                }
            });
        });

    });
</script>