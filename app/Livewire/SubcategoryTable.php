<?
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subcategory;

class SubcategoryTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;

    // Updating sort field and direction
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Render the component with filtered, sorted, and paginated data
    public function render()
    {
        $subcategories = Subcategory::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('slugs', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.subcategory-table', [
            'subcategories' => $subcategories,
        ]);
    }
}
