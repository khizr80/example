<!-- Main modal with backdrop -->
<div id="edit-subcategory-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center">
    <!-- Greyed-out background -->
    <div class="fixed inset-0 bg-gray-900 opacity-50"></div>

    <!-- Modal content -->
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Subcategory
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
            <div class="pt-0 pr-4 pb-4 pl-4 md:pr-5 md:pb-5 md:pl-5">
                <form id="editSubcategoryForm" class="space-y-4" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Subcategory ID Field -->
                    <input type="hidden" name="subcategory_id" id="subcategory_id" />

                    <!-- Title Field -->
                    <div>
                        <label for="edit-subcategory-title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="edit-subcategory-title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />
                    </div>

                    <!-- Slugs Field -->
                    <div>
                        <label for="edit-subcategory-slugs"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slugs</label>
                        <input type="text" name="slugs" id="edit-subcategory-slugs"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />
                    </div>
                    <div>
                        <label for="category-select"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select name="CategoryID" id="category-selecter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="">Select a category</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Subcategory
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        function loadCategories(selectedCategoryID) {

            $.ajax({
                url: "{{ route('get') }}", // Adjust this route as per your setup
                method: 'GET',
                success: function (response) {
                    if (Array.isArray(response) && response.length > 0) {
                        let options = '<option value="">Select a category</option>';

                        response.forEach(category => {
                            if (category.id && category.title) {
                                const isSelected = category.id == selectedCategoryID ? 'selected' : '';
                                options += `<option value="${category.id}" ${isSelected}>${category.title}</option>`;
                            }
                        });

                        $('#category-selecter').html(options);
                    } else {
                        $('#category-select').html('<option value="">No categories available</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Failed to load categories:', error);
                    $('#category-select').html('<option value="">Error loading categories</option>');
                }
            });
        }
   // Updated getid function with a callback
function getid(id, callback) {
    $.ajax({
        url: "{{ route('getid') }}",
        method: 'GET',
        data: { id: id },
        success: function (response) {
            if (typeof callback === 'function') {
                callback(response.received_id);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
        }
    });
}
 subcategoryId=null;
$(document).on('click', '.edit-subcategory', function () {
    const subcategoryId = this.parentNode.parentNode.children[0].textContent;
    const subcategoryTitle = this.parentNode.parentNode.children[1].textContent;
    const subcategorySlugs = this.parentNode.parentNode.children[2].textContent;
title=this.parentNode.parentNode.children[1]
slugs=this.parentNode.parentNode.children[2]
categoryname=this.parentNode.parentNode.children[3]
console.log(categoryname);

    getid(subcategoryId, function (categoryID) {
        loadCategories(categoryID);
        $('#subcategory_id').val(subcategoryId);
        $('#edit-subcategory-title').val(subcategoryTitle);
        $('#edit-subcategory-slugs').val(subcategorySlugs);
        $('#edit-subcategory-modal').removeClass('hidden').addClass('flex');
    });
});

        // Close modal when clicking the close button
        $('.close-modal').click(function () {
            $('#edit-subcategory-modal').addClass('hidden').removeClass('flex');
        });

        // Close modal when clicking outside the modal content
        $(document).mouseup(function (e) {
            const modal = $("#edit-subcategory-modal");
            const modalContent = modal.find('.relative');

            if (!modalContent.is(e.target) && modalContent.has(e.target).length === 0) {
                modal.addClass('hidden').removeClass('flex');
            }
        });

        // Handle form submission for editing subcategory
        $('#editSubcategoryForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission
            const subcategoryId = $('#subcategory_id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: "{{route('updateSubcategory')}}", // Adjust the route as needed
                type: 'PUT',
                data: formData,
                success: function (response) {
                    showToast('Subcategory updated successfully!', 'success');
                    $('#edit-subcategory-modal').addClass('hidden').removeClass('flex');
                    const updatedTitle = $('#edit-subcategory-title').val(); // Get the updated title
                const updatedSlugs = $('#edit-subcategory-slugs').val(); // Get the updated slugs
                const selectedText = $('#category-selecter option:selected').text();
                title.textContent=updatedTitle;
                slugs.textContent=updatedSlugs;
                categoryname.textContent=selectedText;
                },
                error: function (xhr) {
                    let errorMessage = 'An error occurred!';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showToast(errorMessage, 'error');
                }
            });
        });
    });
</script>
