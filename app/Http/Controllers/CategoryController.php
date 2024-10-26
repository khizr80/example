<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select(['id', 'title', 'slugs', 'created_at', 'updated_at']);
            
            return DataTables::of($data)
                ->addColumn('action', function($row) {
            $actions = '';
                   
                    if(session('role')=="admin")
                    {
                        $editUrl = route('editCategory', $row->id);
                        $actions = '
                            <a href="' . $editUrl . '" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
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
    public function create()
    {
        return view('addCategory'); // Make sure you have this view in resources/views
    }
    public function add(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'slugs' => 'required|string', 
            ]);

            Category::create([
                'title' => $request->input('title'),
                'slugs' => $request->input('slugs'),
            ]);
            return redirect()->route('categories')->with('status', 'success')->with('message', 'Category added successfully!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'fail')->with('message', $e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $category = Category::find($id);
        return view('editCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slugs' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        $category->title = $request->input('title');
        $category->slugs = $request->input('slugs');
        $category->save();

        return redirect()->route('categories')->with('status', 'success')->with('message', 'Category updated successfully!');
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
