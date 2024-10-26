<?php
namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubcategoryController extends Controller
{
   
    public function getSubcategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Subcategory::select(['id', 'title', 'slugs']);
            return DataTables::of($data)
            
                ->addColumn('action', function ($row) {
                    $btn = '';
                   
                    if(session('role')=="admin")
                    {
                    $btn = '<a href="'.route('editSubcategory', $row->id).'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete-subcategory bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>';
                    }
                    return $btn;
                })
                ->make(true);
        }
        return view('subcategories');
    }


    public function create()
    {
        $categories = Category::all();  // Fetch all categories
        return view('addSubcategory', compact('categories'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slugs' => 'required|string|max:255',
            'CategoryID' => 'nullable|exists:categories,id',
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategories')->with('status', 'success')->with('message', 'Subcategory created successfully!');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('editSubcategory', compact('subcategory', 'categories'));
    }
    
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slugs' => 'required|string|max:255',
            'CategoryID' => 'nullable|exists:categories,id',
        ]);

        $subcategory->update($request->all());
        return redirect()->route('subcategories')->with('status', 'success')->with('message', 'Subcategory updated successfully!');
    }
    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return response()->json(['success' => 'Subcategory deleted successfully.']);
    }
}
