<x-base>
    @section('content')
    @include('partials.navAdmin')
    @include('addSubcategory')
    @include('editSubcategory')
    
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto mt-8">
            @if (session('role') == "admin")
                <button
                    class="toggle-modal bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                    Add Subcategory
                </button>
            @endif

            <div class="container mx-auto mt-8">
    <div class="mb-4">
        <input 
            type="text" 
            placeholder="Search..." 
            class="border px-4 py-2" 
            wire:model.debounce.500ms="search"
        />
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            
            <tbody>
                @forelse ($subcategories as $subcategory)
                <tr>
                    <td class="px-4 py-2 border">{{ $subcategory->id }}</td>
                    <td class="px-4 py-2 border">{{ $subcategory->title }}</td>
                    <td class="px-4 py-2 border">{{ $subcategory->slugs }}</td>
                    <td class="px-4 py-2 border">
                        <button 
                            class="text-red-600 hover:text-red-800"
                            wire:click="delete({{ $subcategory->id }})">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 border text-center">No Subcategories Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="mt-4">
            {{ $subcategories->links() }}
        </div>
    </div>
</div>

            <!-- @livewire('subcategory-table') -->
        </div>
    </body>
    @endsection
</x-base>
