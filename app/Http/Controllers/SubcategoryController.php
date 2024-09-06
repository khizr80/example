<?php
namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function getAllSubcategories()
    {
        $subcategories = Subcategory::all();
        return view('subcategories', compact('subcategories'));
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

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories')->with('status', 'success')->with('message', 'Subcategory deleted successfully!');
    }
}
