<!-- Main modal with backdrop -->
<div id="subcategory-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center">
    <!-- Greyed-out background -->
    <div class="fixed inset-0 bg-gray-900 opacity-50"></div>

    <!-- Modal content -->
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add New Subcategory
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
                <form id="addSubcategoryForm" class="space-y-4" method="POST">
                    @csrf
                    <!-- Title Field -->
                    <div>
                        <label for="subcategory-name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="subcategory-name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Subcategory Title" required />
                    </div>

                    <!-- Slugs Field -->
                    <div>
                        <label for="subcategory-slug"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slugs</label>
                        <input type="text" name="slugs" id="subcategory-slug"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="subcategory-slug" required />
                    </div>

                    <div>
                        <label for="category-select"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select name="CategoryID" id="category-select"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="">Select a category</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add Subcategory
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        // Open modal
        function loadCategories() {
            
            $.ajax({
                url: "{{route('get')}}",
                method: 'GET',
                success: function (response) {
                    console.log(response);
                    if (Array.isArray(response)) {
                let options = '<option value="">Select a category</option>';
                response.forEach(category => {
                    options += `<option value="${category.id}">${category.title}</option>`;
                });
                $('#category-select').html(options);
            } else {
                console.error('Response is not an array:', response);
            }
                },
                error: function () {

                    console.error('Failed to load categories');
                }
            });
        }
        $('.toggle-modal').click(function () {
            $('#subcategory-modal').removeClass('hidden').addClass('flex');
            loadCategories(); // Load categories when opening the modal

        });

        // Close modal
        $('.close-modal').click(function () {
            $('#subcategory-modal').addClass('hidden').removeClass('flex');
        });

        // Close modal when clicking outside of it
        $(document).mouseup(function (e) {
            const modal = $("#subcategory-modal");
            const modalContent = modal.find('.relative.bg-white');

            if (!modalContent.is(e.target) && modalContent.has(e.target).length === 0) {
                modal.addClass('hidden').removeClass('flex');
            }
        });

        // Form submission via AJAX
        $('#addSubcategoryForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission
            const formData = $(this).serialize(); // Serialize form data
            console.log(formData);
            
            $.ajax({
                url: "{{ route('addSubcategory') }}", // Your Laravel route for adding a subcategory
                type: 'POST',
                data: formData,
                success: function (response) {
                    showToast('Subcategory added successfully!', 'success');
                    $('#subcategory-modal').addClass('hidden').removeClass('flex');
                    $('#subcategories-table').DataTable().ajax.reload(); // Reload DataTable if applicable
                },
                error: function (xhr) {
                    let errorMessage = 'An error occurred!';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showToast(errorMessage, 'error');
                    $('#subcategory-modal').addClass('hidden').removeClass('flex');
                }
            });
        });
    });
</script>