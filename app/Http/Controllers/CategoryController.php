<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Apply 'role' middleware to protect methods
        $this->middleware('role:admin')->only(['create', 'add', 'edit', 'update', 'deleteCategory']);
        $this->middleware('auth')->only(['getCategories']);
    }
    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select(['id', 'title', 'slugs']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actions = '';

                    if (session('role') == "admin") {
                        $actions = '
                            <button type="button" class=" edit-category bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-category bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>
                        ';
                    }
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
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
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['success' => 'Category deleted successfully.']);
        } else {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }
}
