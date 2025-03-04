<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Apply 'role' middleware to protect methods
        // $this->middleware('role:admin')->only(['create', 'add', 'edit', 'update', 'deleteCategory']);
        $this->middleware('auth')->only(['getCategories']);
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select(['id', 'title', 'slugs']);
            return DataTables::of($data)->make(true);
        }

        return view('categories');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slugs' => 'required|string|max:255|unique:categories,slugs',
        ]);
    
        Category::create($request->all());
    
        return response()->json(['message' => 'Category added successfully!']);
    }

    public function edit(Request $request)
    {
        try {
            $category = Category::findOrFail($request['category_id']);
            $category->title = $request['title'];
            $category->slugs = $request['slugs'];
            $category->save();
            return response()->json(['message' => 'Category updated successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteCategory($id)
    {
        // Simple role check using session
        if (session('role') !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['success' => 'Category deleted successfully.']);
        }
        return response()->json(['error' => 'Category not found.'], 404);
    }

}
