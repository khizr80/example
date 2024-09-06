<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
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
    
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->route('categories')->with('status', 'success')->with('message', 'Category deleted successfully!');
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
}
