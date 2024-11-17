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
            <thead>
                <tr>
                    <th class="px-4 py-2 border cursor-pointer" wire:click="sortBy('id')">
                        Id 
                        @if ($sortField === 'id')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </th>
                    <th class="px-4 py-2 border cursor-pointer" wire:click="sortBy('title')">
                        Title 
                        @if ($sortField === 'title')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </th>
                    <th class="px-4 py-2 border cursor-pointer" wire:click="sortBy('slugs')">
                        Slugs 
                        @if ($sortField === 'slugs')
                            <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
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
