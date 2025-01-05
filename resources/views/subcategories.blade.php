<x-base>
    @section('content')
    @include('partials.navAdmin')
    @include('addSubcategory')
    @include('editSubcategory')

    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            @if (session('role') == "admin")
                <button type="button"
                    class="toggle-modal py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Add
                    SubCategory</button>
            @endif

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    id="categories-table">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                id
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                title
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                slugs
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Category Name
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>


                <div class="flex flex-col items-center">
                <span class="text-sm text-gray-700 dark:text-gray-400">
        Showing <span class="font-semibold text-gray-900 dark:text-white" id="start-index">1</span> to <span class="font-semibold text-gray-900 dark:text-white" id="end-index">10</span> of <span class="total-pages font-semibold text-gray-900 dark:text-white"></span> Entries
    </span>
                    <nav aria-label="Page navigation example">
                        <ul class="page flex items-center -space-x-px h-10 text-base"></ul>
                    </nav>

                </div>

            </div>
            <script>
                $(document).ready(function () {
                    let currentPage = 0; // Initialize current page to 0

                    window.load = function loadTableData(page = 0) {
                        $.ajax({
                            url: '{{ url("/subcategories") }}',
                            method: 'GET',
                            data: { page: page }, // Send the page number to the server
                            success: function (response) {
                                console.log(response.data[0].category.title);

                                const totalItems = response.data.length;
                                const itemsPerPage = 10;
                                const totalPages = Math.ceil(totalItems / itemsPerPage);

                                $('.total-pages').text(totalItems);
                                $('#categories-table tbody').empty();
                                const startIndex = page * itemsPerPage + 1;
                                 const endIndex = Math.min(startIndex + itemsPerPage - 1, totalItems);
                                $('#start-index').text(startIndex);
                                $('#end-index').text(endIndex);

                                for (let i = startIndex; i < endIndex; i++) {
                                    const subcategory = response.data[i];
                                    $('#categories-table tbody').append(`
                            <tr data-id="${subcategory.id}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">${subcategory.id}</td>
                                <td class="px-6 py-4">${subcategory.title}</td>
                                <td class="px-6 py-4">${subcategory.slugs}</td>
                                <td class="px-6 py-4">${subcategory.category.title}</td>
                                <td class="text-right px-6 whitespace-nowrap">
                                    <button href="javascript:void()" class="edit-subcategory toggle-modal py-2 px-3 font-medium text-blue-600 hover:text-indigo-500 duration-150 hover:bg-gray-50 rounded-lg">Edit</button>
                                    <button id="delete-subcategory" data-id=${subcategory.id} class="delete-category py-2 leading-none px-3 font-medium text-red-600 hover:text-red-500 duration-150 hover:bg-gray-50 rounded-lg">Delete</button>
                                </td>
                            </tr>
                        `);
                                }

                                updatePaginationButtons(page, totalPages);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    }

                    function updatePaginationButtons(page, totalPages) {
                        const paginationContainer = $('.page');
                        paginationContainer.empty();

                        // Previous button
                        paginationContainer.append(`
        <li>
            <button href="#"
                class="prev-page flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="sr-only">Previous</span>
                <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
            </button>
        </li>
    `);

                        if (totalPages > 3) {
                            for (let i = 0; i < 3; i++) {
                                paginationContainer.append(`
                <li>
                    <button class=" ${page === i ? 'flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'page-number flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'}" data-page="${i}">${i + 1}
                    </button>
                </li>
            `);
                            }

                            paginationContainer.append(`
            <li>
                <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</span>
            </li>
        `);

                            // Add last two pages
                            for (let i = totalPages - 2; i < totalPages; i++) {
                                paginationContainer.append(`
                <li>
                   <button class=" ${page === i ? 'flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'page-number flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'}" data-page="${i}">${i + 1}
                    </button>
                </li>
            `);
                            }
                        } else {
                            // If less than 4 pages, display all
                            for (let i = 0; i < totalPages; i++) {
                                paginationContainer.append(`
                <li>
                    <button class="page-number flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ${page === i ? 'active' : ''}" data-page="${i}">
                        ${i + 1}
                    </button>
                </li>
            `);
                            }
                        }

                        // Next button
                        paginationContainer.append(`
        <li>
            <button href="#"
                class="next-page flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="sr-only">Next</span>
                <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
            </button>
        </li>
    `);
                    }
                    window.load();

                    $(document).on('click', '.prev-page', function () {
                        if (currentPage > 0) {
                            currentPage--;
                            window.load(currentPage);

                        }
                    });

                    $(document).on('click', '.next-page', function () {
                        currentPage++;
                        window.load(currentPage);

                    });

                    $(document).on('click', '.page-number', function () {
                        const page = $(this).data('page');
                        currentPage = page;
                        window.load(currentPage);


                    });

                    $(document).on('click', '#delete-subcategory', function () {
                        const id = $(this).data('id');
                        console.log('Deleting category with ID:', id, $(this));

                        $.ajax({
                            url: '/subcategories/' + id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (data) {
                                showToast('Category deleted successfully!', 'success');
                                window.load(currentPage);
                            },
                            error: function (xhr) {
                                showToast('An error occurred while deleting the category', 'error');
                            }
                        });
                    });
                });
            </script>

    </body>
    @endsection
</x-base>