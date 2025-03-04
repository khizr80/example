<?php
namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:admin')->only(['create','add','edit','update','delete']);
        // $this->middleware('auth')->only(['getSubcategories']);
    }
    public function getSubcategories(Request $request)
{
    if ($request->ajax()) {
        $data = Subcategory::with('category') // Eager load category relationship
            ->select(['id', 'title', 'slugs', 'CategoryID']); // Select the columns you need
        
        return DataTables::of($data)
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : 'No category'; // Access category name via relationship
            })
            ->make(true);
    }

    return view('subcategories');
}

    public function getid(Request $request)
    {
        $s = Subcategory::findOrFail($request['id']);
        return response()->json(['received_id' => $s['CategoryID']]);


    }
    public function getCat()
    {
        $categories = Category::all()->toArray();
        return response()->json($categories, 200);
    }


    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slugs' => 'required|string|max:255',
            'CategoryID' => 'nullable|exists:categories,id',
        ]);
        Subcategory::create($request->all());
        return response()->json(['message' => 'Subcategory created successfully'], 201);
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'slugs' => 'required|string|max:255',
                'CategoryID' => 'nullable|exists:categories,id',
            ]);
            $subcategory = Subcategory::find($request['subcategory_id']);
            $subcategory->update($validatedData);
            return response()->json(['success' => 'Subcategory updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return response()->json(['success' => 'Subcategory deleted successfully.']);
    }
}
